<?php

test('the homepage introduces Firstlight and its native implementation', function () {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('More native UI. Same Blade.')
        ->assertSee('Shane Rosenthal')
        ->assertSee('Simon Hamp')
        ->assertSee('https://nativephp.com', false)
        ->assertSee('SwiftUI')
        ->assertSee('Jetpack Compose')
        ->assertSee('composer require firstlightui/nativephp')
        ->assertSee('https://github.com/firstlightui/nativephp/blob/main/docs/components/segmented.md', false)
        ->assertDontSee('Laravel has an incredibly rich ecosystem');
});
