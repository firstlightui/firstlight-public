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
            'status' => 'coming_soon',
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
            'requirements' => null,
            'install' => [],
            'usage' => null,
            'docs' => null,
            'github' => 'https://github.com/firstlightui/local-ocr',
            'packagist' => null,
        ],
        [
            'slug' => 'local-ai',
            'name' => 'Local AI',
            'package' => 'firstlightui/local-ai',
            'status' => 'coming_soon',
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
            'requirements' => null,
            'install' => [],
            'usage' => null,
            'docs' => null,
            'github' => 'https://github.com/firstlightui/local-ai',
            'packagist' => null,
        ],
    ],
];
