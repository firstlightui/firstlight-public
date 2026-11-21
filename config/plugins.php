<?php

/*
 * NativePHP Mobile plugins Firstlight publishes alongside firstlightui/nativephp.
 *
 * A plugin is "available" once it has a stable release; until then it is "coming_soon" and the
 * site shows no install command for it. Never print version numbers here: they change with
 * every release and are approved separately.
 */

return [
    'plugins' => [
        [
            'slug' => 'app-guard',
            'name' => 'App Guard',
            'package' => 'firstlightui/app-guard',
            'status' => 'available',
            'summary' => 'An app lock for NativePHP Mobile: hide the app in the app switcher, cover it when it returns after a timeout, keep protected screens closed, and copy secrets to a clipboard that clears itself.',
            'description' => 'App Guard gives NativePHP Mobile apps the pieces of an app lock that the platform doesn’t provide. It holds the lock state, guards routes and covers the app natively. Your app draws the lock screen, so it looks like the rest of the app. Pair it with NativePHP’s biometrics plugin for Face ID, Touch ID or fingerprint unlock.',
            'features' => [
                ['Privacy cover', 'Blurs the app in the iOS app switcher. On Android it sets FLAG_SECURE, which also blocks screenshots and screen recording.'],
                ['Return shield', 'After a timeout you choose, an opaque view covers the app before its first frame on return, so nothing shows until your lock screen is ready. It shows your own image, your splash screen or your app icon.'],
                ['App lock', 'An app-lock route middleware and a RequiresUnlock trait keep protected screens closed while the app is locked, including deep links. The unlocked state lives in memory, so every cold start begins locked.'],
                ['Optional PIN', 'Stores only a password hash in secure storage, with a wrong-attempt budget that survives restarts.'],
                ['Sensitive copy', 'Puts text on the clipboard for this device only and removes it after up to an hour.'],
                ['Lifecycle events', 'Backgrounded and Foregrounded, with time away measured natively on a clock that keeps running while the device sleeps.'],
            ],
            'platforms' => [
                ['App switcher', 'A blur over the app while it is inactive', 'FLAG_SECURE: the app shows blank and can’t be captured'],
                ['Return after the timeout', 'The shield over every window before the first frame', 'The shield over the window before the first frame'],
                ['Unlock prompt, with nativephp/mobile-biometrics', 'Face ID or Touch ID, falling back to the device passcode', 'Fingerprint or face unlock, with no passcode fallback'],
            ],
            'requirements' => 'Requires PHP 8.4 or later, NativePHP Mobile ^4.7, iOS 18 or later, Android 10 (API 29) or later. The PIN needs nativephp/mobile-secure-storage at runtime.',
            'install' => [
                'composer require firstlightui/app-guard',
                'php artisan native:plugin:register firstlightui/app-guard',
            ],
            'usage' => [
                'file' => 'routes/native.php and VaultScreen.php',
                'code' => <<<'PHP'
Route::middleware('app-lock')->group(function () {
    Route::native('/vault', VaultScreen::class)->name('vault');
    Route::native('/lock', LockScreen::class)->name('lock');
});

// A screen with protected content
class VaultScreen extends NativeComponent
{
    use RequiresUnlock;
}
PHP,
            ],
            'docs' => [
                'label' => 'Build an app lock screen',
                'path' => 'how-to/build-an-app-lock-screen',
            ],
            'github' => 'https://github.com/firstlightui/app-guard',
            'packagist' => 'https://packagist.org/packages/firstlightui/app-guard',
        ],
        [
            'slug' => 'local-ocr',
            'name' => 'Local OCR',
            'package' => 'firstlightui/local-ocr',
            'status' => 'available',
            'summary' => 'Scan multi-page documents with the system scanner and read their text on the phone: VisionKit and Apple Vision on iOS, ML Kit on Android.',
            'description' => 'Local OCR opens the platform’s own document scanner, then recognises the text without sending an image or a word off the device. It returns structured text for each page, ready for your app to interpret, or for an on-device model to work with.',
            'features' => [
                ['System document scanner', 'The user scans as many pages as they need in the platform’s own scanner. Pages are kept as JPEGs in the app’s private temporary storage until you discard them.'],
                ['On-device text recognition', 'Blocks, lines and words for each page, with confidence scores and bounding boxes.'],
                ['Capability check', 'Reports whether capture and recognition are available on the device before you offer them.'],
                ['Asynchronous, Laravel-style', 'Capture and recognition return straight away and report back through events, with fluent callbacks or #[On] listeners on your screen.'],
                ['PHP and JavaScript', 'A PHP facade, plus a JavaScript package for apps with a web front end.'],
            ],
            'platforms' => [
                ['Scanner', 'VisionKit document camera', 'ML Kit Document Scanner, in Google Play services'],
                ['Text recognition', 'Apple Vision, with a choice of languages and a fast mode', 'ML Kit Text Recognition, Latin script, bundled model'],
                ['Requires', 'iOS 18 or later; capture needs a real device', 'Android 8 (API 26) or later with Google Play services'],
            ],
            'requirements' => 'Requires PHP 8.4 or later, NativePHP Mobile ^4.6.1, iOS 18 or later, Android 8 (API 26) or later with Google Play services. Capture needs a real device; recognition also runs in the iOS Simulator.',
            'install' => [
                'composer require firstlightui/local-ocr',
                'php artisan native:plugin:register firstlightui/local-ocr',
            ],
            'usage' => [
                'file' => 'ScanScreen.php',
                'code' => <<<'PHP'
LocalOcr::capture()
    ->pagesCaptured(function (PagesCaptured $event) {
        LocalOcr::recognize($event->pages)
            ->textRecognized(function (TextRecognized $result) use ($event) {
                $this->text = $result->result['text'];
                LocalOcr::discard($event->pages);
            });
    })
    ->captureCancelled(fn () => $this->status = 'Cancelled');
PHP,
            ],
            'docs' => [
                'label' => 'Scan documents and read their text',
                'path' => 'how-to/scan-documents',
            ],
            'github' => 'https://github.com/firstlightui/local-ocr',
            'packagist' => 'https://packagist.org/packages/firstlightui/local-ocr',
        ],
        [
            'slug' => 'local-ai',
            'name' => 'Local AI',
            'package' => 'firstlightui/local-ai',
            'status' => 'available',
            'summary' => 'Generate text with the model already on the phone: Apple Foundation Models on iOS and Gemini Nano on Android. Prompts and output never leave the device.',
            'description' => 'Local AI uses the operating system’s built-in language model. It doesn’t download a model or run its own inference engine, and it never sends a prompt or its output anywhere. On a device without a supported model it says why, so your app can offer something else.',
            'features' => [
                ['The model the phone already has', 'Apple Foundation Models on iOS, Gemini Nano through ML Kit GenAI on Android.'],
                ['Prompts and chats', 'Generate from one prompt with optional instructions, or continue a conversation, with temperature and a token limit.'],
                ['Streamed output', 'Each chunk of text arrives as an event, then a completed, failed or cancelled event. Cancel a generation at any time.'],
                ['Availability with a reason', 'Tells you whether the model is available, downloadable, downloading or unavailable, and why, such as Apple Intelligence being turned off.'],
                ['Survives navigation', 'Each generation has an ID, so a screen can pick up its text again after the user navigates away and back.'],
            ],
            'platforms' => [
                ['Model', 'Apple Foundation Models', 'Gemini Nano, through the ML Kit GenAI Prompt API'],
                ['Generates on', 'iOS 26 or later on a device with Apple Intelligence turned on', 'Devices that support AICore, with a locked bootloader'],
                ['Installs on', 'iOS 18 or later', 'Android 10 (API 29) or later'],
            ],
            'requirements' => 'Requires PHP 8.3 or later and NativePHP Mobile ^4.6.1. Installs on iOS 18 or later and Android 10 (API 29) or later; generates on iOS 26 with Apple Intelligence, or on an Android device with Gemini Nano.',
            'install' => [
                'composer require firstlightui/local-ai',
                'php artisan native:plugin:register firstlightui/local-ai',
            ],
            'usage' => [
                'file' => 'AskScreen.php',
                'code' => <<<'PHP'
public function ask(): void
{
    if (LocalAI::availability()->isAvailable()) {
        $this->id = LocalAI::generate('Name a cat.')->id;
    }
}

#[On(TextDeltaGenerated::class)]
public function delta(string $id, int $sequence, string $delta): void
{
    $this->answer .= $delta;
}
PHP,
            ],
            'docs' => [
                'label' => 'Generate text on the device',
                'path' => 'how-to/generate-text-on-device',
            ],
            'github' => 'https://github.com/firstlightui/local-ai',
            'packagist' => 'https://packagist.org/packages/firstlightui/local-ai',
        ],
        [
            'slug' => 'custom-tabs',
            'name' => 'Custom Tabs',
            'package' => 'firstlightui/custom-tabs',
            'status' => 'coming_soon',
            'summary' => 'Let people choose and reorder your app’s tabs, within the tabs, locks and limits you declare, with a More screen for the rest.',
            'description' => 'Custom Tabs lets the people using your app arrange its tab bar. You declare the tabs once in PHP, lock the ones that must stay put and set how many fit. People drag tabs between the bar and More in a native editor, and their choice is in the bar from the first frame at launch.',
            'features' => [
                ['Declared in PHP', 'Tabs, icons and the default order in one definition, with locked tabs, tabs that start in More, a limit on the bar and Laravel Gates for tabs only some people may see.'],
                ['A native editor', 'Firstlight’s Reorder List with Tab bar and More sections. Dragging works, and so do VoiceOver and TalkBack actions. Nothing changes until Done.'],
                ['The rules on every move', 'A tab dropped into a full bar pushes the last movable tab into More straight away, and locked tabs never move.'],
                ['A More screen', 'Tabs moved out of the bar stay one tap away, with their badges and an Edit button.'],
                ['Saved on the device', 'The choice is kept in a small file on the device, or in your own store if you sync it to an account. Tabs added in a later version find their place on their own.'],
            ],
            'platforms' => [
                ['Tab bar', 'The system tab bar, with Liquid Glass on iOS 26', 'Material 3 navigation bar, or Firstlight’s tab bar'],
                ['Editor', 'An edit-mode SwiftUI list with reorder handles', 'Material 3 rows with drag handles and haptics'],
                ['Accessibility', 'VoiceOver actions: Move up, Move down, Move to More', 'TalkBack actions: Move up, Move down, Move to More'],
            ],
            'screenshots' => [
                ['src' => 'images/plugins/custom-tabs/ios-bar-light.png', 'alt' => 'The tab bar: Home, Inbox with a badge of 3, Calendar, Reports and More'],
                ['src' => 'images/plugins/custom-tabs/ios-editor-light.png', 'alt' => 'The Edit tabs screen: Home locked, Inbox, Calendar and Reports in the tab bar, People and Files in More'],
                ['src' => 'images/plugins/custom-tabs/ios-more-light.png', 'alt' => 'The More screen listing People and Files, with an Edit button'],
            ],
            'docs' => [
                'label' => 'Let people customise their tabs',
                'path' => 'how-to/let-people-customise-tabs',
            ],
            'github' => 'https://github.com/firstlightui/custom-tabs',
            'packagist' => null,
        ],
        [
            'slug' => 'app-shortcuts',
            'name' => 'App Shortcuts',
            'package' => 'firstlightui/app-shortcuts',
            'status' => 'coming_soon',
            'summary' => 'Open screens or run PHP from Siri, Spotlight, the Shortcuts app and the app icon’s long-press menu, even when the app is closed.',
            'description' => 'App Shortcuts lets people reach your app from outside it. You declare shortcuts once in a config file: some open a named route, others run a PHP action without opening the app, and Siri or Android says what PHP replied. It is in alpha while the NativePHP changes it relies on are released.',
            'features' => [
                ['Declared in config', 'Each shortcut has a stable id, a title, an icon and either a route to open or an action to run.'],
                ['Siri phrases on iOS', 'Up to 10 shortcuts with spoken phrases work in Siri with no setup by the user, and every shortcut appears in Spotlight and the Shortcuts app.'],
                ['The app icon menu', 'Up to 4 shortcuts in the long-press menu on both platforms, which people can pin to the home screen on Android.'],
                ['Runs PHP when closed', 'An action shortcut runs your PHP without opening the app and replies with text the system reads out or shows.'],
                ['Added at runtime', 'Add or remove long-press menu shortcuts while the app runs, such as for recent items.'],
            ],
            'platforms' => [
                ['Spotlight and Shortcuts', 'Every shortcut, also for the Action button', 'None'],
                ['Voice', 'Siri, with phrases', 'None yet'],
                ['App icon menu', 'Up to 4 shortcuts', 'Up to 4 shortcuts, pinnable to the home screen'],
            ],
            'docs' => [
                'label' => 'Add Siri and app icon shortcuts',
                'path' => 'how-to/add-app-shortcuts',
            ],
            'github' => 'https://github.com/firstlightui/app-shortcuts',
            'packagist' => null,
        ],
    ],
];
