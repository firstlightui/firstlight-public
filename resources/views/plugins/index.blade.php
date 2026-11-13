@inject('structuredData', 'App\\StructuredData')

@php
    $plugins = config('plugins.plugins', []);
    $eyebrow = 'font-mono text-base uppercase tracking-wide text-(--site-primary) sm:text-sm';
    $code = 'font-mono text-[0.95em]';
    $card = 'group flex flex-col items-start gap-3 rounded-(--radius-panel) bg-(--site-canvas) p-6 ring-1 ring-(--site-border) hover:bg-(--site-elevated) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)';
    $cardEyebrow = 'font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-primary)';
    $cardLink = 'pt-2 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 group-hover:decoration-(--site-primary) sm:text-sm';
    $textLink = 'rounded-sm py-2 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm';
    $quietLink = 'rounded-sm py-2 text-base font-normal text-(--site-muted) underline decoration-(--site-border-strong) underline-offset-4 hover:text-(--site-heading) hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm';
    $statusLabels = ['available' => 'Available', 'coming_soon' => 'Coming soon'];

    $highlight = fn (string $source): string => implode("\n", array_map(
        fn (string $line): string => str_starts_with(ltrim($line), '//')
            ? '<span class="text-(--site-code-muted)">'.e($line).'</span>'
            : e($line),
        explode("\n", $source),
    ));

    $terminal = fn (array $commands): string => implode("\n", array_map(
        fn (string $command): string => '<span class="text-(--site-code-muted)">$</span> '.e($command),
        $commands,
    ));
@endphp

<x-layouts.app
    title="Firstlight plugins — App Guard, Local OCR and Local AI for NativePHP"
    description="NativePHP Mobile plugins from Firstlight: App Guard locks and covers your app, and on-device OCR and on-device AI are coming soon. Free and MIT licensed."
    main-class="isolate overflow-hidden"
    :schema="$structuredData->plugins($plugins)"
>
    <section class="border-b border-(--site-border) bg-(--site-surface) py-16 sm:py-20">
        <div class="mx-auto flex max-w-7xl flex-col gap-12 px-6 lg:px-8">
            <div class="grid items-end gap-8 lg:grid-cols-[13fr_11fr]">
                <div class="flex flex-col gap-5">
                    <p class="font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-primary)">Plugins</p>
                    <h1 class="max-w-[18ch] text-5xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-6xl">Native features for NativePHP apps.</h1>
                </div>
                <p class="max-w-[54ch] text-lg text-pretty text-(--site-muted)">
                    Firstlight also builds NativePHP Mobile plugins for what the phone can do and NativePHP doesn’t expose yet. Each one is free and MIT licensed, and works with or without Firstlight’s controls.
                </p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($plugins as $plugin)
                    <a href="#{{ $plugin['slug'] }}" class="{{ $card }}" data-plugin-card="{{ $plugin['slug'] }}">
                        <p class="{{ $cardEyebrow }}">{{ $statusLabels[$plugin['status']] }}</p>
                        <p class="text-xl font-semibold text-(--site-heading)">{{ $plugin['name'] }}</p>
                        <p class="text-base text-pretty text-(--site-muted) sm:text-sm">{{ $plugin['summary'] }}</p>
                        <span class="{{ $cardLink }} mt-auto">{{ $plugin['status'] === 'available' ? 'See what it does' : 'See what’s coming' }} →</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @foreach ($plugins as $plugin)
        <section
            id="{{ $plugin['slug'] }}"
            data-plugin="{{ $plugin['slug'] }}"
            @class([
                'scroll-mt-24 py-20 sm:py-24',
                'border-y border-(--site-border) bg-(--site-surface)' => $loop->even,
            ])
        >
            <div class="mx-auto grid max-w-7xl items-start gap-12 px-6 lg:grid-cols-[11fr_13fr] lg:px-8">
                <div class="flex min-w-0 flex-col gap-6">
                    <div class="flex flex-col items-start gap-5">
                        <div class="flex flex-wrap items-center gap-3">
                            <p class="{{ $eyebrow }}">{{ $plugin['package'] }}</p>
                            @if ($plugin['status'] === 'available')
                                <span class="rounded-full bg-dawn-100 px-3 py-1 text-sm font-medium text-dawn-800 dark:bg-dawn-900 dark:text-dawn-200">{{ $statusLabels['available'] }}</span>
                            @else
                                <span class="rounded-full bg-(--site-recessed) px-3 py-1 text-sm font-medium text-(--site-muted) ring-1 ring-(--site-border)">{{ $statusLabels['coming_soon'] }}</span>
                            @endif
                        </div>
                        <h2 class="text-4xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-5xl">{{ $plugin['name'] }}</h2>
                        <p class="max-w-[58ch] text-lg text-pretty text-(--site-muted)">{{ $plugin['description'] }}</p>
                    </div>

                    <dl class="flex flex-col divide-y divide-(--site-border) border-y border-(--site-border)">
                        @foreach ($plugin['features'] as [$feature, $detail])
                            <div class="flex flex-col gap-1 py-4">
                                <dt class="font-semibold text-(--site-heading)">{{ $feature }}</dt>
                                <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">{{ $detail }}</dd>
                            </div>
                        @endforeach
                    </dl>

                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                        @if ($plugin['docs'])
                            <a href="{{ route('docs.show', ['path' => $plugin['docs']['path']]) }}" class="{{ $textLink }}">{{ $plugin['docs']['label'] }} →</a>
                        @endif
                        <a href="{{ $plugin['github'] }}" class="{{ $plugin['docs'] ? $quietLink : $textLink }}" target="_blank" rel="noreferrer">{{ $plugin['status'] === 'available' ? 'GitHub' : 'Follow on GitHub →' }}</a>
                        @if ($plugin['packagist'])
                            <a href="{{ $plugin['packagist'] }}" class="{{ $quietLink }}" target="_blank" rel="noreferrer">Packagist</a>
                        @endif
                    </div>
                </div>

                <div class="flex min-w-0 flex-col gap-5">
                    <figure class="flex flex-col gap-3">
                        <div class="relative overflow-hidden rounded-[min(4vw,var(--radius-panel))] p-4 ring-1 ring-(--site-border) dawn-field sm:p-6 sm:pb-12" role="img" aria-label="Illustration of {{ $plugin['name'] }} on iOS and Android">
                            <div class="absolute inset-0 technical-grid opacity-45" aria-hidden="true"></div>
                            <div class="relative" aria-hidden="true">
                                @include('plugins.mockups.'.$plugin['slug'])
                            </div>
                        </div>
                        <figcaption class="text-sm text-(--site-muted)">
                            {{ $plugin['status'] === 'available' ? 'Illustration, not a screenshot. Your app draws its own lock screen.' : 'Illustration of the plugin in development, not a screenshot.' }}
                        </figcaption>
                    </figure>

                    <dl class="divide-y divide-(--site-border) overflow-hidden rounded-(--radius-panel) bg-(--site-canvas) ring-1 ring-(--site-border) sm:hidden">
                        @foreach ($plugin['platforms'] as [$behaviour, $ios, $android])
                            <div class="flex flex-col gap-1 px-4 py-4 text-base">
                                <dt class="font-medium text-(--site-heading)">{{ $behaviour }}</dt>
                                <dd class="text-(--site-muted)"><span class="text-(--site-heading)">iOS:</span> {{ $ios }}</dd>
                                <dd class="text-(--site-muted)"><span class="text-(--site-heading)">Android:</span> {{ $android }}</dd>
                            </div>
                        @endforeach
                    </dl>

                    <div class="hidden overflow-hidden rounded-(--radius-panel) ring-1 ring-(--site-border) sm:block">
                        <table class="w-full text-left text-sm">
                            <caption class="sr-only">{{ $plugin['name'] }} on iOS and Android</caption>
                            <thead class="bg-(--site-recessed) text-(--site-heading)">
                                <tr>
                                    <th scope="col" class="px-3 py-3 font-semibold sm:px-5"><span class="sr-only">Behaviour</span></th>
                                    <th scope="col" class="px-3 py-3 font-semibold sm:px-5">iOS</th>
                                    <th scope="col" class="px-3 py-3 font-semibold sm:px-5">Android</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-(--site-border) bg-(--site-canvas) text-(--site-muted)">
                                @foreach ($plugin['platforms'] as [$behaviour, $ios, $android])
                                    <tr>
                                        <th scope="row" class="px-3 py-3 align-top font-medium text-(--site-heading) sm:px-5">{{ $behaviour }}</th>
                                        <td class="px-3 py-3 align-top sm:px-5">{{ $ios }}</td>
                                        <td class="px-3 py-3 align-top sm:px-5">{{ $android }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($plugin['status'] === 'available')
                        <div class="min-w-0 rounded-(--radius-panel) bg-(--site-code) p-5 ring-1 ring-(--site-border) sm:p-6">
                            <p class="border-b border-white/10 pb-4 font-mono text-base text-(--site-code-muted) sm:text-sm">Terminal</p>
                            <pre class="overflow-x-auto pt-5 font-mono text-base text-(--site-code-text) sm:text-sm"><code>{!! $terminal($plugin['install']) !!}</code></pre>
                        </div>

                        <div class="min-w-0 rounded-(--radius-panel) bg-(--site-code) p-5 ring-1 ring-(--site-border) sm:p-6">
                            <p class="border-b border-white/10 pb-4 font-mono text-base text-(--site-code-muted) sm:text-sm">{{ $plugin['usage']['file'] }}</p>
                            <pre class="overflow-x-auto pt-5 font-mono text-base text-(--site-code-text) sm:text-sm"><code>{!! $highlight($plugin['usage']['code']) !!}</code></pre>
                        </div>

                        <p class="text-base text-pretty text-(--site-muted) sm:text-sm">{{ $plugin['requirements'] }}</p>
                    @else
                        <div class="flex flex-col gap-2 rounded-(--radius-panel) bg-(--site-canvas) p-6 ring-1 ring-(--site-border)">
                            <p class="{{ $cardEyebrow }}">Coming soon</p>
                            <p class="text-base text-pretty text-(--site-muted) sm:text-sm">
                                {{ $plugin['name'] }} is in development, and its API may change before its first stable release. This page will show how to install it when it ships. Follow <a href="{{ $plugin['github'] }}" class="font-medium text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">{{ $plugin['package'] }}</a> on GitHub for progress.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endforeach
</x-layouts.app>
