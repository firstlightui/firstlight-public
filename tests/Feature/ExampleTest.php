<?php

test('the homepage introduces Firstlight and its native implementation', function () {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('Native by platform. Familiar in Blade.')
        ->assertSee('NativePHP Mobile UI')
        ->assertSee('alternative native-first implementations')
        ->assertSee('SuperNative supplies the bridge.')
        ->assertSee('Shane Rosenthal')
        ->assertSee('Simon Hamp')
        ->assertSee('https://nativephp.com', false)
        ->assertSee('SwiftUI')
        ->assertSee('Jetpack Compose')
        ->assertSee('composer require firstlightui/nativephp')
        ->assertSee(route('docs.show', ['path' => 'components/segmented']), false)
        ->assertSee('data-theme-toggle', false)
        ->assertSee(asset('theme.js'), false)
        ->assertDontSee('Laravel has an incredibly rich ecosystem');
});

test('the homepage presents every configured component with native evidence', function () {
    $response = $this->get(route('home'))->assertSuccessful();

    $response
        ->assertSee('Native-first alternatives. More building blocks to come.')
        ->assertSee('data-component-catalogue-track', escape: false)
        ->assertSee('component-evidence-image', escape: false);

    foreach (config('component-gallery.components') as $component) {
        $marker = 'data-component-card="'.$component['slug'].'"';

        $response
            ->assertSee($marker, escape: false)
            ->assertSee(route('docs.show', ['path' => 'components/'.$component['slug']]), escape: false);

        if ($component['mocked'] ?? false) {
            $response
                ->assertSee('data-component-evidence="mock"', escape: false)
                ->assertSee('data-component-mock="'.$component['slug'].'"', escape: false);
        } else {
            $response
                ->assertSee($component['screenshots']['ios']['light'], escape: false)
                ->assertSee($component['screenshots']['ios']['dark'], escape: false)
                ->assertSee($component['screenshots']['android']['light'], escape: false)
                ->assertSee($component['screenshots']['android']['dark'], escape: false);
        }

        expect(substr_count($response->getContent(), $marker))->toBe(1);
    }
});

test('the component catalogue presents every configured component once', function () {
    $response = $this->get(route('components.index'))->assertSuccessful();

    foreach (config('component-gallery.components') as $component) {
        $marker = 'data-component-index-card="'.$component['slug'].'"';

        $response
            ->assertSee($marker, escape: false)
            ->assertSee(route('docs.show', ['path' => 'components/'.$component['slug']]), escape: false);

        expect(substr_count($response->getContent(), $marker))->toBe(1);
    }
});
