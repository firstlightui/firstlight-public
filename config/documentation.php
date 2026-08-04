<?php

return [
    'repository' => env('DOCUMENTATION_GITHUB_REPOSITORY', 'firstlightui/nativephp'),
    'branch' => env('DOCUMENTATION_GITHUB_BRANCH', 'main'),
    'path' => env('DOCUMENTATION_GITHUB_PATH', 'docs'),

    'cache' => [
        'fresh' => (int) env('DOCUMENTATION_CACHE_FRESH_SECONDS', 900),
        'stale' => (int) env('DOCUMENTATION_CACHE_STALE_SECONDS', 86400),
    ],
];
