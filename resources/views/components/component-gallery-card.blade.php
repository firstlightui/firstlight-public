@props(['component'])

<article
    data-component-card="{{ $component['slug'] }}"
    data-component-evidence="{{ ($component['mocked'] ?? false) ? 'mock' : 'screenshots' }}"
    class="overflow-hidden rounded-[min(3vw,var(--radius-panel))] bg-(--site-surface) ring-1 ring-(--site-border)"
>
    <div class="grid lg:grid-cols-[5fr_7fr]">
        <div class="flex flex-col justify-between gap-10 p-6 sm:p-8 lg:p-10">
            <div class="flex flex-col gap-5">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="flex flex-wrap items-baseline gap-3">
                        <h3 class="text-2xl font-semibold tracking-tight text-(--site-heading)">
                            <a
                                href="{{ route('docs.show', ['path' => 'components/'.$component['slug']]) }}"
                                class="rounded-sm underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)"
                            >
                                {{ $component['title'] }}
                            </a>
                        </h3>
                        <span class="rounded-full bg-dawn-100 px-3 py-1 text-sm font-medium text-dawn-800 dark:bg-dawn-900 dark:text-dawn-200">
                            {{ $component['availability'] }}
                        </span>
                    </div>

                    <span class="font-mono text-sm text-(--site-muted)">{{ $component['tag'] }}</span>
                </div>

                <p class="max-w-[52ch] text-base text-pretty text-(--site-muted)">
                    {{ $component['summary'] }}
                </p>
            </div>

            <a
                href="{{ route('docs.show', ['path' => 'components/'.$component['slug']]) }}"
                class="group/link inline-flex min-h-11 items-center gap-2 self-start rounded-sm py-2 font-semibold text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)"
            >
                Explore {{ $component['title'] }}
                <span class="text-(--site-primary) transition-transform group-hover/link:translate-x-1 motion-reduce:transition-none" aria-hidden="true">→</span>
            </a>
        </div>

        <div class="border-t border-(--site-border) bg-(--site-recessed) lg:border-t-0 lg:border-l">
            <div class="flex min-h-14 items-center justify-between gap-4 border-b border-(--site-border) px-4 py-3 sm:px-5">
                <span class="font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-muted)">
                    {{ ($component['mocked'] ?? false) ? 'Illustrated native states' : 'Native evidence' }}
                </span>
                <span class="size-1.5 rounded-full bg-(--site-primary)" aria-hidden="true"></span>
            </div>

            <div class="grid gap-px bg-(--site-border) sm:grid-cols-2">
                @foreach (['ios' => 'iOS', 'android' => 'Android'] as $platform => $platformLabel)
                    <figure class="min-w-0 bg-(--site-canvas)">
                        <figcaption class="flex items-center justify-between gap-3 bg-(--site-recessed) px-4 py-3 sm:px-5">
                            <span class="font-medium text-(--site-heading)">{{ $platformLabel }}</span>
                            <span class="font-mono text-xs uppercase tracking-[0.12em] text-(--site-muted)">
                                {{ ($component['mocked'] ?? false) ? 'Illustration' : 'Native' }}
                            </span>
                        </figcaption>

                        <div class="flex h-72 items-center justify-center p-6 sm:h-96 sm:p-8 lg:h-[30rem]">
                            @if ($component['mocked'] ?? false)
                                <x-button-platform-mock :platform="$platform" />
                            @else
                                <picture class="flex h-full w-full items-center justify-center">
                                    <source media="(prefers-color-scheme: dark)" srcset="{{ $component['screenshots'][$platform]['dark'] }}">
                                    <img
                                        src="{{ $component['screenshots'][$platform]['light'] }}"
                                        alt="{{ $component['screenshots'][$platform]['alt'] }}"
                                        class="h-auto max-h-full w-auto max-w-full object-contain object-center"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </picture>
                            @endif
                        </div>
                    </figure>
                @endforeach
            </div>
        </div>
    </div>
</article>
