<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Cache::flush();
    Http::preventStrayRequests();

    config()->set([
        'documentation.repository' => 'firstlightui/nativephp',
        'documentation.branch' => 'main',
        'documentation.path' => 'docs',
        'documentation.cache.fresh' => 900,
        'documentation.cache.stale' => 86400,
        'services.github.token' => null,
    ]);
});

it('builds and caches the documentation page and navigation from GitHub', function () {
    Http::fake([
        'api.github.com/repos/firstlightui/nativephp/git/trees/main*' => Http::response(documentationTree()),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/index.md' => Http::response(documentationIndex()),
    ]);

    $this->get('/docs')
        ->assertSuccessful()
        ->assertSee('Firstlight UI Documentation')
        ->assertSee('Getting Started')
        ->assertSee('Installation')
        ->assertSee('/docs/getting-started/installation', escape: false)
        ->assertDontSee('description: Current guides', escape: false);

    $this->get('/docs')->assertSuccessful();

    Http::assertSentCount(2);
});

it('selects a fresh document cache entry when the GitHub blob SHA changes', function () {
    Http::fake([
        'api.github.com/repos/firstlightui/nativephp/git/trees/main*' => Http::sequence()
            ->push(documentationTree('index-sha-one'))
            ->push(documentationTree('index-sha-two')),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/index.md' => Http::sequence()
            ->push(documentationIndex('Version one.'))
            ->push(documentationIndex('Version two.')),
    ]);

    $this->get('/docs')
        ->assertSuccessful()
        ->assertSee('Version one.');

    Cache::forget('documentation:'.sha1('firstlightui/nativephp@main:navigation'));

    $this->get('/docs')
        ->assertSuccessful()
        ->assertSee('Version two.')
        ->assertDontSee('Version one.');

    Http::assertSentCount(4);
});

it('renders safe Markdown and rewrites relative documentation targets', function () {
    Http::fake([
        'api.github.com/repos/firstlightui/nativephp/git/trees/main*' => Http::response(documentationTree()),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/index.md' => Http::response(documentationIndex()),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/components/segmented.md' => Http::response(<<<'MARKDOWN'
---
title: Segmented control for NativePHP
description: Native segmented controls for Firstlight UI.
---

# Segmented

Read the [compatibility reference](../reference/compatibility.md).

![Segmented on iOS](../screenshots/segmented/ios-light.png)

<script>alert('unsafe')</script>

[Unsafe](javascript:alert('unsafe'))
MARKDOWN),
    ]);

    $this->get('/docs/components/segmented')
        ->assertSuccessful()
        ->assertSee('Segmented control for NativePHP')
        ->assertSee('<span>Segmented</span>', escape: false)
        ->assertDontSee('<span>Segmented control for NativePHP</span>', escape: false)
        ->assertSee('Segmented')
        ->assertSee('/docs/reference/compatibility', escape: false)
        ->assertSee('https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/segmented/ios-light.png', escape: false)
        ->assertDontSee('<script>', escape: false)
        ->assertDontSee('href="javascript:', escape: false);
});

it('serves an llms text index with absolute links from the cached GitHub source', function () {
    Http::fake([
        'api.github.com/repos/firstlightui/nativephp/git/trees/main*' => Http::response(documentationTree()),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/index.md' => Http::response(documentationIndex()),
    ]);

    $this->get('/llms.txt')
        ->assertSuccessful()
        ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
        ->assertSee('# Firstlight UI')
        ->assertSee(route('docs.show', ['path' => 'getting-started/installation']), escape: false)
        ->assertSee('GitHub repository');

    Http::assertSentCount(2);
});

it('returns not found without requesting arbitrary GitHub paths', function () {
    Http::fake([
        'api.github.com/repos/firstlightui/nativephp/git/trees/main*' => Http::response(documentationTree()),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/index.md' => Http::response(documentationIndex()),
    ]);

    $this->get('/docs/../../composer')->assertNotFound();

    Http::assertSentCount(2);
});

it('shows a themed unavailable page when GitHub has no cached response', function () {
    Http::fake([
        'api.github.com/*' => Http::response(status: 503),
    ]);

    $this->get('/docs')
        ->assertStatus(503)
        ->assertSee('The source is taking a moment.')
        ->assertSee('Open GitHub docs');
});

/**
 * @return array{tree: array<int, array{path: string, type: string, sha: string}>}
 */
function documentationTree(string $indexSha = 'index-sha'): array
{
    return [
        'tree' => [
            ['path' => 'docs/index.md', 'type' => 'blob', 'sha' => $indexSha],
            ['path' => 'docs/getting-started/installation.md', 'type' => 'blob', 'sha' => 'installation-sha'],
            ['path' => 'docs/getting-started/first-component.md', 'type' => 'blob', 'sha' => 'first-component-sha'],
            ['path' => 'docs/components/segmented.md', 'type' => 'blob', 'sha' => 'segmented-sha'],
            ['path' => 'docs/concepts/server-authoritative-state.md', 'type' => 'blob', 'sha' => 'state-sha'],
            ['path' => 'docs/reference/compatibility.md', 'type' => 'blob', 'sha' => 'compatibility-sha'],
            ['path' => 'docs/screenshots/segmented/ios-light.png', 'type' => 'blob', 'sha' => 'screenshot-sha'],
        ],
    ];
}

function documentationIndex(string $extra = ''): string
{
    $markdown = <<<'MARKDOWN'
---
title: Firstlight UI Documentation
description: Current guides, concepts, and reference documentation for developers using Firstlight UI.
---

# Firstlight UI Documentation

- [Installation](getting-started/installation.md)
- [Your first component](getting-started/first-component.md)
- [Segmented](components/segmented.md)
- [Server-authoritative state](concepts/server-authoritative-state.md)
- [Compatibility](reference/compatibility.md)
MARKDOWN;

    return $extra === '' ? $markdown : $markdown."\n\n".$extra;
}
