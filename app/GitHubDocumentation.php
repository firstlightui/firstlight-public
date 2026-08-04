<?php

namespace App;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Throwable;

class GitHubDocumentation
{
    public function llmsText(): string
    {
        $documents = $this->documents();
        $indexDocument = Arr::first($documents, fn (array $document): bool => $document['slug'] === 'index');

        if ($indexDocument === null) {
            throw new DocumentationUnavailable('The GitHub documentation index is missing.');
        }

        $markdown = $this->document($indexDocument['source_path'], $indexDocument['sha']);
        [$frontMatter, $body] = $this->extractFrontMatter($markdown);
        $trimmedBody = Str::of($body)->ltrim()->toString();
        $bodyWithoutHeading = preg_replace('/\A#\s+.+\R+/u', '', $trimmedBody, 1) ?? $trimmedBody;
        $description = $frontMatter['description'] ?? 'Firstlight UI documentation for NativePHP developers.';

        return Str::of("# Firstlight UI\n\n> {$description}\n\n## Documentation\n\n")
            ->append($this->rewriteRelativeTargets($bodyWithoutHeading, $indexDocument['source_path'], absolute: true))
            ->append("\n\n## Source\n\n- [GitHub repository]({$this->docsSourceUrl()})\n")
            ->toString();
    }

    /**
     * @return array{
     *     slug: string,
     *     title: string,
     *     description: string,
     *     html: string,
     *     source_url: string,
     *     navigation: array{
     *         overview: array{slug: string, title: string, source_path: string, sha: string, section: string|null}|null,
     *         sections: array<int, array{title: string, documents: array<int, array{slug: string, title: string, source_path: string, sha: string, section: string|null}>}>
     *     },
     *     previous: array{slug: string, title: string, source_path: string, sha: string, section: string|null}|null,
     *     next: array{slug: string, title: string, source_path: string, sha: string, section: string|null}|null
     * }|null
     */
    public function find(?string $requestedPath): ?array
    {
        $slug = $this->normalizeSlug($requestedPath);
        $documents = $this->documents();
        $currentIndex = Arr::first(array_keys($documents), fn (int $index): bool => $documents[$index]['slug'] === $slug);

        if ($currentIndex === null) {
            return null;
        }

        $currentDocument = $documents[$currentIndex];
        $markdown = $this->document($currentDocument['source_path'], $currentDocument['sha']);
        [$frontMatter, $body] = $this->extractFrontMatter($markdown);
        $pageTitle = $frontMatter['title'] ?? $currentDocument['title'];

        return [
            'slug' => $slug,
            'title' => $pageTitle,
            'description' => $frontMatter['description'] ?? '',
            'html' => Str::markdown($this->rewriteRelativeTargets($body, $currentDocument['source_path']), [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ]),
            'source_url' => $this->sourceUrl($currentDocument['source_path']),
            'navigation' => $this->navigation($documents),
            'previous' => $documents[$currentIndex - 1] ?? null,
            'next' => $documents[$currentIndex + 1] ?? null,
        ];
    }

    /**
     * @return array<int, array{slug: string, title: string, source_path: string, sha: string, section: string|null}>
     */
    private function documents(): array
    {
        return Cache::flexible(
            $this->cacheKey('navigation'),
            $this->cacheTimes(),
            fn (): array => $this->fetchDocuments(),
        );
    }

    /**
     * @return array<int, array{slug: string, title: string, source_path: string, sha: string, section: string|null}>
     */
    private function fetchDocuments(): array
    {
        $payload = $this->getJson(sprintf(
            'https://api.github.com/repos/%s/git/trees/%s?recursive=1',
            $this->repository(),
            rawurlencode($this->branch()),
        ));
        $tree = Arr::get($payload, 'tree');

        if (! is_array($tree)) {
            throw new DocumentationUnavailable('GitHub returned an invalid documentation tree.');
        }

        $sourceBlobs = [];

        foreach ($tree as $entry) {
            if (! is_array($entry) || Arr::get($entry, 'type') !== 'blob') {
                continue;
            }

            $path = Arr::get($entry, 'path');
            $sha = Arr::get($entry, 'sha');

            if (! is_string($path) || ! is_string($sha) || ! Str::startsWith($path, $this->docsRoot().'/') || ! Str::endsWith($path, '.md')) {
                continue;
            }

            $sourceBlobs[$path] = $sha;
        }

        $indexPath = $this->docsRoot().'/index.md';

        if (! isset($sourceBlobs[$indexPath])) {
            throw new DocumentationUnavailable('The GitHub documentation index is missing.');
        }

        $indexMarkdown = $this->document($indexPath, $sourceBlobs[$indexPath]);
        [$indexFrontMatter, $indexBody] = $this->extractFrontMatter($indexMarkdown);
        $documentsByPath = [];

        foreach ($sourceBlobs as $sourcePath => $sha) {
            $documentsByPath[$sourcePath] = $this->documentDescriptor($sourcePath, $sha);
        }

        $indexDocument = $this->documentDescriptor($indexPath, $sourceBlobs[$indexPath]);
        $indexDocument['title'] = $indexFrontMatter['title'] ?? 'Overview';
        $documentsByPath[$indexPath] = $indexDocument;
        $orderedDocuments = [$indexDocument];

        foreach ($this->indexLinks($indexBody, $indexPath) as $link) {
            if (! isset($documentsByPath[$link['source_path']]) || $link['source_path'] === $indexPath) {
                continue;
            }

            $documentsByPath[$link['source_path']]['title'] = $link['title'];
            $orderedDocuments[] = $documentsByPath[$link['source_path']];
            unset($documentsByPath[$link['source_path']]);
        }

        unset($documentsByPath[$indexPath]);
        ksort($documentsByPath);

        return [...$orderedDocuments, ...array_values($documentsByPath)];
    }

    private function document(string $sourcePath, string $sha): string
    {
        return Cache::flexible(
            $this->cacheKey('document:'.$sourcePath.':'.$sha),
            $this->cacheTimes(),
            fn (): string => $this->getText($this->rawUrl($sourcePath)),
        );
    }

    /**
     * @return array{slug: string, title: string, source_path: string, sha: string, section: string|null}
     */
    private function documentDescriptor(string $sourcePath, string $sha): array
    {
        $slug = $this->slugForSourcePath($sourcePath);
        $section = Str::contains($slug, '/') ? Str::before($slug, '/') : null;

        return [
            'slug' => $slug,
            'title' => Str::headline(Str::afterLast($slug, '/')),
            'source_path' => $sourcePath,
            'sha' => $sha,
            'section' => $section,
        ];
    }

    /**
     * @param  array<int, array{slug: string, title: string, source_path: string, sha: string, section: string|null}>  $documents
     * @return array{
     *     overview: array{slug: string, title: string, source_path: string, sha: string, section: string|null}|null,
     *     sections: array<int, array{title: string, documents: array<int, array{slug: string, title: string, source_path: string, sha: string, section: string|null}>}>
     * }
     */
    private function navigation(array $documents): array
    {
        $overview = null;
        $sections = [];

        foreach ($documents as $document) {
            if ($document['slug'] === 'index') {
                $overview = $document;

                continue;
            }

            $section = $document['section'] ?? 'documentation';

            if (! isset($sections[$section])) {
                $sections[$section] = [
                    'title' => Str::headline($section),
                    'documents' => [],
                ];
            }

            $sections[$section]['documents'][] = $document;
        }

        return [
            'overview' => $overview,
            'sections' => array_values($sections),
        ];
    }

    /**
     * @return array<int, array{title: string, source_path: string}>
     */
    private function indexLinks(string $markdown, string $indexPath): array
    {
        preg_match_all(
            '/\[(?<title>[^\]]+)]\((?<target>[^)\s]+\.md(?:#[^)]*)?)\)/',
            $markdown,
            $matches,
            PREG_SET_ORDER,
        );

        $links = [];

        foreach ($matches as $match) {
            $sourcePath = $this->resolveSourcePath($indexPath, Str::before($match['target'], '#'));

            if ($sourcePath === null) {
                continue;
            }

            $links[] = [
                'title' => $match['title'],
                'source_path' => $sourcePath,
            ];
        }

        return $links;
    }

    private function rewriteRelativeTargets(string $markdown, string $sourcePath, bool $absolute = false): string
    {
        $rewritten = preg_replace_callback(
            "~(?<label>!?\\[[^\\]]*\\])\\((?<target>[^)\\s]+)(?<title>\\s+(?:\"[^\"]*\"|'[^']*'))?\\)~",
            function (array $matches) use ($absolute, $sourcePath): string {
                $target = $matches['target'];

                if (Str::startsWith($target, ['http://', 'https://', 'mailto:', 'tel:', '#', '/'])) {
                    return $matches[0];
                }

                $targetPath = Str::before($target, '#');
                $fragment = Str::contains($target, '#') ? '#'.Str::after($target, '#') : '';
                $resolvedPath = $this->resolveSourcePath($sourcePath, $targetPath);

                if ($resolvedPath === null) {
                    return $matches[0];
                }

                if (Str::startsWith($matches['label'], '!')) {
                    $url = $this->rawUrl($resolvedPath);
                } elseif (Str::endsWith($resolvedPath, '.md')) {
                    $slug = $this->slugForSourcePath($resolvedPath);
                    $url = $slug === 'index'
                        ? route('docs.show', absolute: $absolute)
                        : route('docs.show', ['path' => $slug], absolute: $absolute);
                    $url .= $fragment;
                } else {
                    $url = $this->sourceUrl($resolvedPath);
                }

                return $matches['label'].'('.$url.($matches['title'] ?? '').')';
            },
            $markdown,
        );

        return $rewritten ?? $markdown;
    }

    private function resolveSourcePath(string $sourcePath, string $target): ?string
    {
        $segments = explode('/', Str::beforeLast($sourcePath, '/'));

        if (Str::startsWith($target, '/')) {
            $segments = [];
            $target = Str::ltrim($target, '/');
        }

        foreach (explode('/', rawurldecode($target)) as $segment) {
            if ($segment === '' || $segment === '.') {
                continue;
            }

            if ($segment === '..') {
                if (count($segments) <= 1) {
                    return null;
                }

                array_pop($segments);

                continue;
            }

            $segments[] = $segment;
        }

        $resolvedPath = implode('/', $segments);

        return Str::startsWith($resolvedPath, $this->docsRoot().'/') ? $resolvedPath : null;
    }

    /**
     * @return array{0: array{title?: string, description?: string}, 1: string}
     */
    private function extractFrontMatter(string $markdown): array
    {
        if (preg_match('/\A---\R(?<front_matter>.*?)\R---\R?/s', $markdown, $matches) !== 1) {
            return [[], $markdown];
        }

        $frontMatter = [];
        $lines = preg_split('/\R/', $matches['front_matter']) ?: [];

        foreach ($lines as $line) {
            if (! Str::contains($line, ':')) {
                continue;
            }

            $key = Str::before($line, ':');

            if (! in_array($key, ['title', 'description'], true)) {
                continue;
            }

            $frontMatter[$key] = trim(Str::after($line, ':'), " \t\n\r\0\x0B\"'");
        }

        return [$frontMatter, Str::after($markdown, $matches[0])];
    }

    /**
     * @return array<string, mixed>
     */
    private function getJson(string $url): array
    {
        try {
            $payload = $this->request(acceptsJson: true)->get($url)->throw()->json();
        } catch (ConnectionException|RequestException $exception) {
            throw new DocumentationUnavailable('GitHub documentation could not be loaded.', previous: $exception);
        }

        if (! is_array($payload)) {
            throw new DocumentationUnavailable('GitHub returned an invalid documentation response.');
        }

        return $payload;
    }

    private function getText(string $url): string
    {
        try {
            return $this->request()->get($url)->throw()->body();
        } catch (ConnectionException|RequestException $exception) {
            throw new DocumentationUnavailable('GitHub documentation could not be loaded.', previous: $exception);
        }
    }

    private function request(bool $acceptsJson = false): PendingRequest
    {
        $request = Http::withHeaders([
            'User-Agent' => 'Firstlight UI Documentation',
            'X-GitHub-Api-Version' => '2022-11-28',
        ])
            ->connectTimeout(3)
            ->timeout(10)
            ->retry(
                [100, 300],
                when: static fn (Throwable $exception): bool => $exception instanceof ConnectionException
                    || ($exception instanceof RequestException && $exception->response->serverError()),
                throw: false,
            );

        if ($acceptsJson) {
            $request->acceptJson();
        }

        $token = config('services.github.token');

        if (is_string($token) && $token !== '') {
            $request->withToken($token);
        }

        return $request;
    }

    private function normalizeSlug(?string $requestedPath): string
    {
        $slug = Str::of($requestedPath ?? 'index')
            ->trim('/')
            ->beforeLast('.md')
            ->toString();

        return $slug === '' ? 'index' : $slug;
    }

    private function slugForSourcePath(string $sourcePath): string
    {
        return Str::of($sourcePath)
            ->after($this->docsRoot().'/')
            ->beforeLast('.md')
            ->toString();
    }

    private function rawUrl(string $sourcePath): string
    {
        return sprintf(
            'https://raw.githubusercontent.com/%s/%s/%s',
            $this->repository(),
            $this->branch(),
            $sourcePath,
        );
    }

    private function sourceUrl(string $sourcePath): string
    {
        return sprintf(
            'https://github.com/%s/blob/%s/%s',
            $this->repository(),
            $this->branch(),
            $sourcePath,
        );
    }

    private function docsSourceUrl(): string
    {
        return sprintf(
            'https://github.com/%s/tree/%s/%s',
            $this->repository(),
            $this->branch(),
            $this->docsRoot(),
        );
    }

    /**
     * @return array{int, int}
     */
    private function cacheTimes(): array
    {
        return [
            (int) config('documentation.cache.fresh', 900),
            (int) config('documentation.cache.stale', 86400),
        ];
    }

    private function cacheKey(string $scope): string
    {
        return 'documentation:'.sha1($this->repository().'@'.$this->branch().':'.$scope);
    }

    private function repository(): string
    {
        return (string) config('documentation.repository', 'firstlightui/nativephp');
    }

    private function branch(): string
    {
        return (string) config('documentation.branch', 'main');
    }

    private function docsRoot(): string
    {
        return trim((string) config('documentation.path', 'docs'), '/');
    }
}
