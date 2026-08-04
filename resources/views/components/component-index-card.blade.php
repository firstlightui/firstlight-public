@props(['component'])

<article
    data-component-index-card="{{ $component['slug'] }}"
    @class([
        'group overflow-hidden rounded-[min(3vw,var(--radius-panel))] bg-(--site-surface) ring-1 ring-(--site-border)',
        'lg:col-span-7' => $component['index_variant'] === 'wide',
        'lg:col-span-5' => $component['index_variant'] === 'medium',
    ])
>
    <div class="flex h-full flex-col">
        <div class="flex flex-1 flex-col justify-between gap-8 p-6 sm:p-8">
            <div class="flex flex-col gap-4">
                <div class="flex flex-wrap items-baseline justify-between gap-3">
                    <h2 class="text-2xl font-semibold tracking-tight text-(--site-heading)">
                        <a href="{{ route('docs.show', ['path' => 'components/'.$component['slug']]) }}" class="rounded-sm underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">{{ $component['title'] }}</a>
                    </h2>
                    <span class="font-mono text-sm text-(--site-muted)">{{ $component['tag'] }}</span>
                </div>
                <p class="max-w-[52ch] text-base text-pretty text-(--site-muted)">{{ $component['summary'] }}</p>
            </div>

            <a href="{{ route('docs.show', ['path' => 'components/'.$component['slug']]) }}" class="group/link inline-flex min-h-11 items-center gap-2 self-start rounded-sm py-2 font-semibold text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">
                Read the docs
                <span class="text-(--site-primary) transition-transform group-hover/link:translate-x-1 motion-reduce:transition-none" aria-hidden="true">→</span>
            </a>
        </div>

        <div @class([
            'h-72 border-t border-(--site-border) bg-(--site-recessed) sm:h-80',
            'flex items-center justify-center p-6 sm:p-8' => $component['mocked'] ?? false,
            'overflow-hidden' => ! ($component['mocked'] ?? false),
        ])>
            @if ($component['mocked'] ?? false)
                <x-button-platform-mock platform="ios" />
            @else
                <div class="h-full w-full">
                    <img
                        src="{{ $component['screenshots']['ios']['light'] }}"
                        alt="{{ $component['screenshots']['ios']['alt'] }}"
                        class="component-evidence-image component-index-evidence-image dark:hidden"
                        loading="lazy"
                        decoding="async"
                        data-component-screenshot="{{ $component['slug'] }}"
                        data-platform="ios"
                    >
                    <img
                        src="{{ $component['screenshots']['ios']['dark'] }}"
                        alt="{{ $component['screenshots']['ios']['alt'] }} in dark mode"
                        class="component-evidence-image component-index-evidence-image hidden dark:block"
                        loading="lazy"
                        decoding="async"
                        data-component-screenshot="{{ $component['slug'] }}"
                        data-platform="ios"
                    >
                </div>
            @endif
        </div>
    </div>
</article>
