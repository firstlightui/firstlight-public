@props([
    'title' => 'Firstlight UI',
    'description' => 'The app-shell layer for NativePHP: genuine SwiftUI and Jetpack Compose controls, Laravel validation, and recipes your coding agent can follow.',
    'mainClass' => 'isolate overflow-hidden',
    'schema' => [],
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scheme-light antialiased dark:scheme-dark" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="description" content="{{ $description }}">
        <meta name="theme-color" content="#fbf7f2" data-theme-color>
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon.png') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="canonical" href="{{ url()->current() }}">

        <title>{{ $title }}</title>

        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Firstlight UI">
        <meta property="og:title" content="{{ $title }}">
        <meta property="og:description" content="{{ $description }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('og.png') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="Firstlight UI — the app-shell layer for NativePHP. Genuine SwiftUI and Jetpack Compose controls with Laravel validation.">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $title }}">
        <meta name="twitter:description" content="{{ $description }}">
        <meta name="twitter:image" content="{{ asset('og.png') }}">

        <link rel="alternate" type="text/plain" href="{{ route('llms') }}" title="llms.txt">
        <link rel="alternate" type="text/plain" href="{{ route('llms.full') }}" title="llms-full.txt">

        @if ($schema !== [])
            <script type="application/ld+json">@json($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
        @endif

        <script src="{{ asset('theme.js') }}"></script>
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-dvh bg-(--site-canvas) font-sans text-(--site-text)">
        <a
            href="#main-content"
            class="fixed top-3 left-3 z-50 -translate-y-20 rounded-full bg-(--site-text) px-4 py-3 text-base font-medium text-(--site-canvas) focus-visible:translate-y-0 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus) sm:text-sm"
        >
            Skip to main content
        </a>

        <header class="relative z-50 border-b border-(--site-border) bg-(--site-canvas)/92 supports-backdrop-filter:bg-(--site-canvas)/80 supports-backdrop-filter:backdrop-blur-xl">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-6 py-4 lg:px-8">
                <a href="{{ route('home') }}" aria-label="Homepage" class="group flex min-w-0 items-center gap-2 rounded-sm focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">
                    <img src="{{ asset('firstlight-icon.png') }}" alt="" width="36" height="36" class="size-9 shrink-0 rounded-lg">
                    <span class="font-semibold tracking-tight text-(--site-heading)">Firstlight</span>
                    <span class="hidden truncate font-mono text-base text-(--site-muted) sm:inline sm:text-sm">/ NativePHP</span>
                </a>

                <div class="flex items-center gap-3">
                    <nav aria-label="Primary navigation" class="hidden items-center gap-7 lg:flex">
                        <a href="{{ route('home') }}#recipes" class="text-sm font-medium text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">Recipes</a>
                        <a href="{{ route('home') }}#agents" class="text-sm font-medium text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">Agents</a>
                        <a href="{{ route('home') }}#accessibility" class="text-sm font-medium text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">Accessibility</a>
                        <a href="{{ route('components.index') }}" class="text-sm font-medium text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" @if (request()->routeIs('components.*')) aria-current="page" @endif>Components</a>
                        <a href="{{ route('docs.show') }}" class="text-sm font-medium text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" @if (request()->routeIs('docs.*')) aria-current="page" @endif>Docs</a>
                        <a href="https://nativephp.com" class="text-sm font-medium text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">NativePHP</a>
                        <a href="https://github.com/firstlightui/nativephp" class="text-sm font-medium text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">GitHub</a>
                    </nav>

                    <button
                        type="button"
                        class="group grid size-11 shrink-0 place-items-center rounded-full text-(--site-muted) ring-1 ring-(--site-border-strong) transition-colors hover:bg-(--site-surface) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)"
                        aria-label="Dark mode"
                        aria-pressed="false"
                        title="Switch to dark mode"
                        data-theme-toggle
                    >
                        <svg class="size-4.5 transition-transform duration-300 group-hover:-rotate-12 dark:hidden motion-reduce:transition-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M21 12.8A8.4 8.4 0 1 1 11.2 3 6.5 6.5 0 0 0 21 12.8Z"></path>
                        </svg>
                        <svg class="hidden size-4.5 transition-transform duration-300 group-hover:rotate-12 dark:block motion-reduce:transition-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="4"></circle>
                            <path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.42"></path>
                        </svg>
                    </button>

                    <div class="flex items-center gap-3 lg:hidden">
                        <a href="{{ route('docs.show') }}" class="rounded-sm py-3 text-base font-medium text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm" @if (request()->routeIs('docs.*')) aria-current="page" @endif>Docs</a>

                        <details class="group relative">
                            <summary class="relative flex min-h-12 cursor-pointer list-none items-center rounded-full px-3 text-base font-medium text-(--site-heading) ring-1 ring-(--site-border-strong) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus) sm:text-sm [&::-webkit-details-marker]:hidden">
                                Menu
                            </summary>
                            <nav aria-label="Mobile navigation" class="absolute top-14 right-0 z-40 grid w-64 gap-1 rounded-(--radius-panel) bg-(--site-elevated) p-2 shadow-xl ring-1 ring-(--site-border) dark:shadow-none">
                                <a href="{{ route('home') }}#recipes" class="rounded-lg px-3 py-3 text-base font-medium text-(--site-muted) hover:bg-(--site-recessed) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-(--site-focus)">Recipes</a>
                                <a href="{{ route('home') }}#agents" class="rounded-lg px-3 py-3 text-base font-medium text-(--site-muted) hover:bg-(--site-recessed) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-(--site-focus)">Agents</a>
                                <a href="{{ route('home') }}#accessibility" class="rounded-lg px-3 py-3 text-base font-medium text-(--site-muted) hover:bg-(--site-recessed) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-(--site-focus)">Accessibility</a>
                                <a href="{{ route('components.index') }}" class="rounded-lg px-3 py-3 text-base font-medium text-(--site-muted) hover:bg-(--site-recessed) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-(--site-focus)" @if (request()->routeIs('components.*')) aria-current="page" @endif>Components</a>
                                <a href="https://nativephp.com" class="rounded-lg px-3 py-3 text-base font-medium text-(--site-muted) hover:bg-(--site-recessed) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">NativePHP</a>
                                <a href="https://github.com/firstlightui/nativephp" class="rounded-lg px-3 py-3 text-base font-medium text-(--site-muted) hover:bg-(--site-recessed) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">GitHub</a>
                            </nav>
                        </details>
                    </div>
                </div>
            </div>
        </header>

        <main id="main-content" class="{{ $mainClass }}">
            {{ $slot }}
        </main>

        <footer class="border-t border-(--site-border)">
            <div class="mx-auto grid max-w-7xl gap-10 px-6 py-12 sm:grid-cols-2 lg:px-8">
                <div class="flex flex-col items-start gap-3">
                    <a href="{{ route('home') }}" aria-label="Homepage" class="flex items-center gap-3 rounded-sm font-semibold tracking-tight text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">
                        <img src="{{ asset('firstlight-icon.png') }}" alt="" width="36" height="36" class="size-9 shrink-0 rounded-lg" loading="lazy">
                        <span>Firstlight UI</span>
                    </a>
                    <p class="max-w-[44ch] text-base text-pretty text-(--site-muted) sm:text-sm">
                        The app-shell layer for NativePHP.
                    </p>
                </div>

                <nav aria-label="Footer navigation" class="flex flex-wrap items-start gap-x-7 gap-y-3 sm:justify-end">
                    <a href="{{ route('components.index') }}" class="text-base font-normal text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">Components</a>
                    <a href="{{ route('home') }}#recipes" class="text-base font-normal text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">Recipes</a>
                    <a href="{{ route('comparison') }}" class="text-base font-normal text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">vs NativePHP Mobile UI</a>
                    <a href="{{ route('docs.show') }}" class="text-base font-normal text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">Documentation</a>
                    <a href="{{ route('llms') }}" class="font-mono text-base font-normal text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">llms.txt</a>
                    <a href="{{ route('pricing') }}" class="font-mono text-base font-normal text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">pricing.md</a>
                    <a href="{{ route('privacy.showcase') }}" class="text-base font-normal text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">Showcase privacy</a>
                    <a href="https://nativephp.com" class="text-base font-normal text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm" target="_blank" rel="noreferrer">NativePHP</a>
                    <a href="mailto:team@firstlightui.dev" class="text-base font-normal text-(--site-muted) hover:text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">Email</a>
                </nav>
            </div>
        </footer>
    </body>
</html>
