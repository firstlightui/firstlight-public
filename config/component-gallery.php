<?php

return [
    'mocked_components' => [
        'button',
    ],

    'components' => [
        [
            'slug' => 'button',
            'title' => 'Button',
            'tag' => 'firstlight:button',
            'availability' => 'Available',
            'summary' => 'Perform immediate actions with native variants, states, icons, and accessible labels on each platform.',
            'index_variant' => 'wide',
            'mocked' => true,
        ],
        [
            'slug' => 'segmented',
            'title' => 'Segmented',
            'tag' => 'firstlight:segmented',
            'availability' => 'Available',
            'summary' => 'Present a small set of mutually exclusive choices as a genuine native segmented control.',
            'index_variant' => 'medium',
            'screenshots' => [
                'ios' => [
                    'light' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/segmented/ios-light.png',
                    'dark' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/segmented/ios-dark.png',
                    'alt' => 'Firstlight Segmented rendered on iOS',
                ],
                'android' => [
                    'light' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/segmented/android-light.png',
                    'dark' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/segmented/android-dark.png',
                    'alt' => 'Firstlight Segmented rendered on Android',
                ],
            ],
        ],
        [
            'slug' => 'status-label',
            'title' => 'Status Label',
            'tag' => 'firstlight:status-label',
            'availability' => 'Available',
            'summary' => 'Present short semantic metadata as a native capsule with platform text scaling and contrast-safe tones.',
            'index_variant' => 'medium',
            'screenshots' => [
                'ios' => [
                    'light' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/status-label/ios-light.png',
                    'dark' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/status-label/ios-dark.png',
                    'alt' => 'Firstlight Status Label rendered on iOS',
                ],
                'android' => [
                    'light' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/status-label/android-light.png',
                    'dark' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/status-label/android-dark.png',
                    'alt' => 'Firstlight Status Label rendered on Android',
                ],
            ],
        ],
        [
            'slug' => 'text-field',
            'title' => 'Text Field',
            'tag' => 'firstlight:text-field',
            'availability' => 'Available',
            'summary' => 'Edit one line of text with each platform’s native keyboard, autofill, selection, icons, and accessibility behaviour.',
            'index_variant' => 'wide',
            'screenshots' => [
                'ios' => [
                    'light' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/text-field/ios-light.png',
                    'dark' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/text-field/ios-dark.png',
                    'alt' => 'Firstlight Text Field rendered on iOS',
                ],
                'android' => [
                    'light' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/text-field/android-light.png',
                    'dark' => 'https://raw.githubusercontent.com/firstlightui/nativephp/main/docs/screenshots/text-field/android-dark.png',
                    'alt' => 'Firstlight Text Field rendered on Android',
                ],
            ],
        ],
    ],
];
