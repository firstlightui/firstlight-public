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
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div class="flex flex-wrap items-baseline gap-3">
                        <h2 class="text-2xl font-semibold tracking-tight text-(--site-heading)">
                            <a href="{{ route('docs.show', ['path' => 'components/'.$component['slug']]) }}" class="rounded-sm underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">{{ $component['title'] }}</a>
                        </h2>
                        <span class="rounded-full bg-dawn-100 px-3 py-1 text-sm font-medium text-dawn-800 dark:bg-dawn-900 dark:text-dawn-200">
                            {{ $component['availability'] }}
                        </span>
                    </div>

                    <span class="font-mono text-sm text-(--site-muted)">{{ $component['tag'] }}</span>
                </div>
                <p class="max-w-[52ch] text-base text-pretty text-(--site-muted)">{{ $component['summary'] }}</p>
            </div>

            <a href="{{ route('docs.show', ['path' => 'components/'.$component['slug']]) }}" class="group/link inline-flex min-h-11 items-center gap-2 self-start rounded-sm py-2 font-semibold text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">
                Read the docs
                <span class="text-(--site-primary) transition-transform group-hover/link:translate-x-1 motion-reduce:transition-none" aria-hidden="true">→</span>
            </a>
        </div>

        <div class="h-72 border-t border-(--site-border) bg-(--site-recessed) sm:h-80">
            <div class="grid h-full grid-cols-2 gap-px bg-(--site-border)">
                @foreach (['ios' => 'iOS', 'android' => 'Android'] as $platform => $platformLabel)
                    <figure class="flex min-w-0 flex-col bg-(--site-canvas)">
                        <figcaption class="flex min-h-11 items-center justify-between gap-2 bg-(--site-recessed) px-3 py-2 sm:px-4">
                            <span class="text-sm font-medium text-(--site-heading)">{{ $platformLabel }}</span>
                            <span class="font-mono text-[0.625rem] uppercase tracking-[0.12em] text-(--site-muted)">Native</span>
                        </figcaption>

                        <div class="min-h-0 flex-1 overflow-hidden">
                            <img
                                src="{{ $component['screenshots'][$platform]['light'] }}"
                                alt="{{ $component['screenshots'][$platform]['alt'] }}"
                                class="component-evidence-image component-index-evidence-image dark:hidden"
                                loading="lazy"
                                decoding="async"
                                data-component-screenshot="{{ $component['slug'] }}"
                                data-platform="{{ $platform }}"
                            >
                            <img
                                src="{{ $component['screenshots'][$platform]['dark'] }}"
                                alt="{{ $component['screenshots'][$platform]['alt'] }} in dark mode"
                                class="component-evidence-image component-index-evidence-image hidden dark:block"
                                loading="lazy"
                                decoding="async"
                                data-component-screenshot="{{ $component['slug'] }}"
                                data-platform="{{ $platform }}"
                            >
                        </div>
                    </figure>
                @endforeach
            </div>
        </div>
    </div>
</article>
