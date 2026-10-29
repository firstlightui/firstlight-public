<?php

test('the showcase privacy policy is public and linked from the website', function () {
    $this->get('/privacy/showcase')
        ->assertSuccessful()
        ->assertSeeText('Firstlight Showcase Privacy Policy')
        ->assertSeeText('Data collection')
        ->assertSeeText('On-device data')
        ->assertSeeText('Camera, photos and files')
        ->assertSeeText('Sample content')
        ->assertSeeText('Apple and Google services')
        ->assertSeeText('Privacy and support contact')
        ->assertSeeText('The app does not upload them.')
        ->assertSee('mailto:team@firstlightui.dev', false);

    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('href="'.route('privacy.showcase').'"', false);
});

test('the homepage introduces Firstlight as the app-shell layer for NativePHP', function () {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSeeText('The app-shell layer for NativePHP.')
        ->assertSee('lists and detail, search, forms with Laravel validation, settings, sheets and dialogs, and feedback')
        ->assertSee('Four screens cover most forms apps.')
        ->assertSee(route('docs.show', ['path' => 'how-to/build-a-list-detail-flow']), false)
        ->assertSee(route('docs.show', ['path' => 'how-to/build-a-searchable-list-screen']), false)
        ->assertSee(route('docs.show', ['path' => 'how-to/build-a-form-screen']), false)
        ->assertSee(route('docs.show', ['path' => 'how-to/build-a-settings-screen']), false)
        ->assertSee('https://github.com/firstlightui/showcase', false)
        ->assertSee('Your agent already knows the recipes.')
        ->assertSee('php artisan boost:install')
        ->assertSee('firstlight-init')
        ->assertSee('building-firstlight-screens')
        ->assertSee(route('llms'), false)
        ->assertSee(route('llms.full'), false)
        ->assertSee(route('docs.show', ['path' => 'getting-started/build-with-a-coding-agent']), false)
        ->assertSee('One API, the right pattern on each platform.')
        ->assertSee('What Firstlight is not')
        ->assertSee('usesNativeChrome()')
        ->assertSee('Not a design system')
        ->assertSee('No charts, no carousels')
        ->assertSee(route('docs.show', ['path' => 'concepts/firstlight-and-mobile-ui']), false)
        ->assertSee('Form Requests, Gates, and Pest on native screens.')
        ->assertSee('@nativeError')
        ->assertSee('->submit(', escape: false)
        ->assertSee('assertFieldError')
        ->assertSee('make:firstlight-screen')
        ->assertSee(route('docs.show', ['path' => 'how-to/validate-fields']), false)
        ->assertSee(route('docs.show', ['path' => 'how-to/submit-forms']), false)
        ->assertSee(route('docs.show', ['path' => 'how-to/authorize-actions']), false)
        ->assertSee(route('docs.show', ['path' => 'how-to/test-screens']), false)
        ->assertSee('Shane Rosenthal')
        ->assertSee('Simon Hamp')
        ->assertSee('https://nativephp.com', false)
        ->assertSee('SwiftUI')
        ->assertSee('Jetpack Compose')
        ->assertSeeText('composer require "firstlightui/nativephp:^1.0@RC"', false)
        ->assertSee('FirstlightUI\\NativeComponent')
        ->assertSee('^4.6')
        ->assertSee('^0.8')
        ->assertSee(route('docs.show', ['path' => 'reference/compatibility']), false)
        ->assertSee(route('docs.show', ['path' => 'components/segmented']), false)
        ->assertSee('data-theme-toggle', false)
        ->assertSee(asset('theme.js'), false)
        ->assertDontSee('curated form and control layer')
        ->assertDontSee('Native form controls for NativePHP');
});

test('the homepage makes accessibility a headline and states its verification status', function () {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('id="accessibility"', false)
        ->assertSee(route('home').'#accessibility', false)
        ->assertSee('Labels and actions for VoiceOver and TalkBack')
        ->assertSee('Validation errors are spoken')
        ->assertSee('Dynamic Type')
        ->assertSee('Right-to-left')
        ->assertSee('Reduce Motion')
        ->assertSee('has not yet been checked on physical devices')
        ->assertSee(route('docs.show', ['path' => 'concepts/accessibility']), false);
});

test('the homepage presents every configured component with native evidence', function () {
    $response = $this->get(route('home'))->assertSuccessful();

    $response
        ->assertSee('Every control, on both platforms.')
        ->assertSee('data-component-catalogue-track', escape: false)
        ->assertSee('component-evidence-image', escape: false)
        ->assertDontSee('data-component-evidence="mock"', escape: false);

    foreach (config('component-gallery.components') as $component) {
        $marker = 'data-component-card="'.$component['slug'].'"';

        $response
            ->assertSee($marker, escape: false)
            ->assertSee(route('docs.show', ['path' => 'components/'.$component['slug']]), escape: false)
            ->assertSee('data-component-evidence="screenshots"', escape: false)
            ->assertSee($component['screenshots']['ios']['light'], escape: false)
            ->assertSee($component['screenshots']['ios']['dark'], escape: false)
            ->assertSee($component['screenshots']['android']['light'], escape: false)
            ->assertSee($component['screenshots']['android']['dark'], escape: false)
            ->assertSee($component['screenshots']['ios']['light'].' 3x', escape: false)
            ->assertSee($component['screenshots']['ios']['dark'].' 3x', escape: false)
            ->assertSee($component['screenshots']['android']['light'].' 3x', escape: false)
            ->assertSee($component['screenshots']['android']['dark'].' 3x', escape: false);

        expect(substr_count($response->getContent(), $marker))->toBe(1);
    }

    $response
        ->assertSee('data-object-position="bottom"', escape: false)
        ->assertSee('data-object-position="center"', escape: false);
});

test('the component catalogue presents every configured component once', function () {
    $response = $this->get(route('components.index'))
        ->assertSuccessful()
        ->assertDontSee('data-component-evidence="mock"', escape: false);

    foreach (config('component-gallery.components') as $component) {
        $marker = 'data-component-index-card="'.$component['slug'].'"';

        $response
            ->assertSee($marker, escape: false)
            ->assertSee(route('docs.show', ['path' => 'components/'.$component['slug']]), escape: false)
            ->assertSee('data-component-evidence="screenshots"', escape: false)
            ->assertSee($component['screenshots']['ios']['light'], escape: false)
            ->assertSee($component['screenshots']['ios']['dark'], escape: false)
            ->assertSee($component['screenshots']['android']['light'], escape: false)
            ->assertSee($component['screenshots']['android']['dark'], escape: false)
            ->assertSee($component['screenshots']['ios']['light'].' 3x', escape: false)
            ->assertSee($component['screenshots']['ios']['dark'].' 3x', escape: false)
            ->assertSee($component['screenshots']['android']['light'].' 3x', escape: false)
            ->assertSee($component['screenshots']['android']['dark'].' 3x', escape: false);

        expect(substr_count($response->getContent(), $marker))->toBe(1);
    }

    $response
        ->assertSee('data-object-position="bottom"', escape: false)
        ->assertSee('data-object-position="center"', escape: false);
});
