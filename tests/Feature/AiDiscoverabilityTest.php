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

function fakeDocumentation(): void
{
    Http::fake([
        'api.github.com/repos/firstlightui/nativephp/git/trees/main*' => Http::response(documentationTree()),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/index.md' => Http::response(documentationIndex()),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/getting-started/installation.md' => Http::response("# Installation\n\nRun `composer require firstlightui/nativephp`."),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/getting-started/first-component.md' => Http::response("# Your first component\n\nAuthor a native field in Blade."),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/components/segmented.md' => Http::response("# Segmented\n\nA native segmented control."),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/concepts/server-authoritative-state.md' => Http::response("# Server-authoritative state\n\nPHP owns the value."),
        'raw.githubusercontent.com/firstlightui/nativephp/main/docs/reference/compatibility.md' => Http::response("# Compatibility\n\nSupported NativePHP versions."),
    ]);
}

it('serves a robots.txt that allows citing AI agents and points at the sitemap', function () {
    $response = $this->get('/robots.txt')->assertSuccessful();

    expect($response->headers->get('Content-Type'))->toContain('text/plain');

    $body = $response->getContent();

    foreach (['GPTBot', 'PerplexityBot', 'ClaudeBot', 'Google-Extended', 'Bingbot', 'Applebot'] as $agent) {
        expect($body)->toContain('User-agent: '.$agent);
    }

    expect($body)
        ->toContain('User-agent: *')
        ->toContain('Sitemap: '.route('sitemap'))
        ->not->toContain('Disallow: /');
});

it('lists every marketing and documentation page in the sitemap', function () {
    fakeDocumentation();

    $response = $this->get('/sitemap.xml')->assertSuccessful();

    expect($response->headers->get('Content-Type'))->toContain('application/xml');

    $body = $response->getContent();

    expect($body)
        ->toContain('<?xml version="1.0" encoding="UTF-8"?>')
        ->toContain('<loc>'.route('home').'</loc>')
        ->toContain('<loc>'.route('components.index').'</loc>')
        ->toContain('<loc>'.route('docs.show').'</loc>')
        ->toContain('<loc>'.route('docs.show', ['path' => 'getting-started/installation']).'</loc>')
        ->toContain('<loc>'.route('docs.show', ['path' => 'components/segmented']).'</loc>');
});

it('still serves a sitemap of marketing pages when GitHub is unreachable', function () {
    Http::fake([
        'api.github.com/*' => Http::response(status: 500),
    ]);

    $this->get('/sitemap.xml')
        ->assertSuccessful()
        ->assertSee(route('home'), escape: false)
        ->assertSee(route('components.index'), escape: false);
});

it('publishes the full documentation text for AI assistants at llms-full.txt', function () {
    fakeDocumentation();

    $response = $this->get('/llms-full.txt')->assertSuccessful();

    expect($response->headers->get('Content-Type'))->toContain('text/plain');

    $body = $response->getContent();

    expect($body)
        ->toContain('# Firstlight UI')
        ->toContain('composer require firstlightui/nativephp')
        ->toContain('A native segmented control.')
        ->toContain('PHP owns the value.')
        ->toContain('Source: '.route('docs.show', ['path' => 'components/segmented'], absolute: true));
});

it('degrades to a plain-text 503 when llms-full.txt cannot reach GitHub', function () {
    Http::fake([
        'api.github.com/*' => Http::response(status: 500),
    ]);

    $this->get('/llms-full.txt')
        ->assertStatus(503)
        ->assertSee('temporarily unavailable');
});

it('describes the package as free software on the home page', function () {
    $response = $this->get('/')->assertSuccessful();

    $schema = extractJsonLd($response->getContent());
    $software = collect($schema['@graph'])->firstWhere('@type', 'SoftwareApplication');

    expect($software)->not->toBeNull()
        ->and($software['name'])->toBe('Firstlight UI')
        ->and($software['isAccessibleForFree'])->toBeTrue()
        ->and($software['offers']['price'])->toBe('0')
        ->and($software['operatingSystem'])->toBe('iOS, Android');

    expect(collect($schema['@graph'])->pluck('@type'))->toContain('Organization');
});

it('never advertises ratings or reviews it does not have', function () {
    fakeDocumentation();

    foreach (['/', '/components', '/docs'] as $uri) {
        $body = $this->get($uri)->assertSuccessful()->getContent();

        expect($body)
            ->not->toContain('aggregateRating')
            ->not->toContain('reviewCount')
            ->not->toContain('ratingValue');
    }
});

it('exposes the component catalogue as a structured list', function () {
    $response = $this->get('/components')->assertSuccessful();

    $schema = extractJsonLd($response->getContent());
    $list = collect($schema['@graph'])->firstWhere('@type', 'ItemList');

    expect($list)->not->toBeNull()
        ->and($list['numberOfItems'])->toBe(count(config('component-gallery.components')))
        ->and($list['itemListElement'][0]['position'])->toBe(1)
        ->and($list['itemListElement'][0]['url'])->toContain('/docs/components/');
});

it('marks documentation pages as technical articles with breadcrumbs', function () {
    fakeDocumentation();

    $response = $this->get('/docs/components/segmented')->assertSuccessful();

    $schema = extractJsonLd($response->getContent());
    $article = collect($schema['@graph'])->firstWhere('@type', 'TechArticle');
    $breadcrumbs = collect($schema['@graph'])->firstWhere('@type', 'BreadcrumbList');

    expect($article)->not->toBeNull()
        ->and($article['headline'])->toBe('Segmented')
        ->and($breadcrumbs['itemListElement'])->toHaveCount(3)
        ->and($breadcrumbs['itemListElement'][2]['name'])->toBe('Segmented');
});

it('gives every page a canonical url and social sharing metadata', function () {
    fakeDocumentation();

    foreach (['/', '/components', '/docs'] as $uri) {
        $body = $this->get($uri)->assertSuccessful()->getContent();

        expect($body)
            ->toContain('<link rel="canonical" href="'.url($uri === '/' ? '' : $uri).'">')
            ->toContain('<meta property="og:title"')
            ->toContain('<meta property="og:description"')
            ->toContain('<meta name="twitter:card" content="summary_large_image">')
            ->toContain('href="'.route('llms').'"')
            ->toContain('href="'.route('llms.full').'"');
    }
});

it('answers the comparison question directly and marks it up as an FAQ', function () {
    $response = $this->get('/firstlight-vs-nativephp-mobile-ui')->assertSuccessful();
    $body = $response->getContent();

    expect($body)
        ->toContain('Firstlight UI vs NativePHP Mobile UI')
        ->toContain('They are not alternatives');

    $schema = extractJsonLd($body);
    $faq = collect($schema['@graph'])->firstWhere('@type', 'FAQPage');
    $questions = collect($faq['mainEntity']);

    expect($questions)->toHaveCount(7)
        ->and($questions->firstWhere('name', 'What does Firstlight add that NativePHP does not have?')['acceptedAnswer']['text'])
        ->toContain('stable public value')
        ->toContain('ValidatesFields')
        ->and($questions->firstWhere('name', 'What do I need to install Firstlight UI?')['acceptedAnswer']['text'])
        ->toContain('NativePHP Mobile ^4.6')
        ->toContain('Mobile UI ^0.8')
        ->toContain('FirstlightUI\\NativeComponent')
        ->and($questions->pluck('name'))->toContain('Does Firstlight UI replace NativePHP Mobile UI?')
        ->and($questions->pluck('name'))->toContain('Is Firstlight UI free?');

    $questions->each(function (array $question): void {
        expect($question['@type'])->toBe('Question')
            ->and($question['acceptedAnswer']['text'])->not->toBeEmpty();
    });

    expect(collect($schema['@graph'])->pluck('@type'))->toContain('BreadcrumbList');
});

it('renders every FAQ answer in the page body, not only in the markup', function () {
    $body = $this->get('/firstlight-vs-nativephp-mobile-ui')->assertSuccessful()->getContent();
    $schema = extractJsonLd($body);
    $faq = collect($schema['@graph'])->firstWhere('@type', 'FAQPage');

    foreach ($faq['mainEntity'] as $question) {
        expect($body)->toContain(e($question['name']));
    }
})->note('Structured data must reflect visible content, not hidden claims.');

it('states the remaining pre-alpha qualification on public adoption pages', function (string $route) {
    $body = $this->get(route($route))->assertSuccessful()->getContent();

    expect(strtolower($body))
        ->toContain('pre-alpha', 'real phones', 'long-running performance tests')
        ->not->toContain('unpatched', 'binary patch', 'streaming', 'response revisions');
})->with(['home', 'comparison', 'pricing']);

it('publishes machine-readable pricing that says the package is free', function () {
    $response = $this->get('/pricing.md')->assertSuccessful();

    expect($response->headers->get('Content-Type'))->toContain('text/markdown');

    $body = $response->getContent();

    expect($body)
        ->toContain('# Pricing — Firstlight UI')
        ->toContain('Price: $0')
        ->toContain('Licence: MIT')
        ->toContain('composer require firstlightui/nativephp')
        ->toContain(route('comparison'))
        ->not->toContain('contact sales');
});

it('points assistants at pricing and the comparison from llms.txt', function () {
    fakeDocumentation();

    $body = $this->get('/llms.txt')->assertSuccessful()->getContent();

    expect($body)
        ->toContain('## Key pages')
        ->toContain(route('pricing', absolute: true))
        ->toContain(route('comparison', absolute: true))
        ->toContain('free and open source');
});

it('lists the comparison page in the sitemap', function () {
    fakeDocumentation();

    $this->get('/sitemap.xml')
        ->assertSuccessful()
        ->assertSee('<loc>'.route('comparison').'</loc>', escape: false);
});

it('ships an open graph image on every page', function () {
    fakeDocumentation();

    expect(file_exists(public_path('og.png')))->toBeTrue();

    [$width, $height] = getimagesize(public_path('og.png'));

    expect($width)->toBe(1200)->and($height)->toBe(630);

    foreach (['/', '/components', '/firstlight-vs-nativephp-mobile-ui', '/docs'] as $uri) {
        $body = $this->get($uri)->assertSuccessful()->getContent();

        expect($body)
            ->toContain('<meta property="og:image" content="'.asset('og.png').'">')
            ->toContain('<meta name="twitter:image" content="'.asset('og.png').'">')
            ->toContain('<meta property="og:image:alt"');
    }
});

/**
 * @return array<string, mixed>
 */
function extractJsonLd(string $html): array
{
    expect(preg_match('~<script type="application/ld\+json">(.*?)</script>~s', $html, $matches))->toBe(1);

    return json_decode($matches[1], true, flags: JSON_THROW_ON_ERROR);
}
