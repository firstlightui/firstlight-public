<x-layouts.app
    :title="$documentation['title'].' — Firstlight UI Docs'"
    :description="$documentation['description'] ?: 'Firstlight UI documentation for NativePHP developers.'"
    main-class="isolate"
>
    <div class="border-b border-(--site-border) bg-(--site-surface)">
        <div class="mx-auto flex max-w-7xl flex-col items-start justify-between gap-5 px-6 py-8 sm:flex-row sm:items-end lg:px-8">
            <div class="flex flex-col gap-2">
                <p class="font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-primary)">Firstlight / Docs</p>
                <p class="max-w-[54ch] text-base text-pretty text-(--site-muted)">
                    Native controls, familiar Blade, and the implementation details in between.
                </p>
            </div>

            <a
                href="{{ $documentation['source_url'] }}"
                class="group inline-flex min-h-11 items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold text-(--site-heading) ring-1 ring-(--site-border-strong) hover:bg-(--site-elevated) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)"
                target="_blank"
                rel="noreferrer"
            >
                View source
                <span class="transition-transform group-hover:translate-x-0.5 motion-reduce:transition-none" aria-hidden="true">↗</span>
            </a>
        </div>
    </div>

    <div class="mx-auto grid max-w-7xl lg:grid-cols-[17rem_minmax(0,1fr)]">
        <aside class="hidden border-r border-(--site-border) lg:block">
            <div class="sticky top-0 max-h-dvh overflow-y-auto px-6 py-10 lg:px-8">
                <x-docs.navigation :navigation="$documentation['navigation']" :current-slug="$documentation['slug']" />
            </div>
        </aside>

        <div class="min-w-0 px-6 py-8 sm:py-12 lg:px-12 lg:py-16 xl:px-16">
            <details class="group mb-10 rounded-(--radius-panel) bg-(--site-surface) ring-1 ring-(--site-border) lg:hidden">
                <summary class="flex min-h-12 cursor-pointer list-none items-center justify-between gap-4 px-4 py-3 font-medium text-(--site-heading) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus) [&::-webkit-details-marker]:hidden">
                    <span class="min-w-0 truncate">{{ $documentation['title'] }}</span>
                    <span class="text-(--site-primary) transition-transform group-open:rotate-45 motion-reduce:transition-none" aria-hidden="true">＋</span>
                </summary>
                <div class="max-h-[65dvh] overflow-y-auto border-t border-(--site-border) px-3 py-5">
                    <x-docs.navigation :navigation="$documentation['navigation']" :current-slug="$documentation['slug']" />
                </div>
            </details>

            <article class="docs-prose max-w-3xl">
                {!! $documentation['html'] !!}
            </article>

            <nav class="mt-16 grid gap-px overflow-hidden rounded-(--radius-panel) bg-(--site-border) ring-1 ring-(--site-border) sm:grid-cols-2" aria-label="Previous and next documentation">
                @if ($documentation['previous'] !== null)
                    <a
                        href="{{ $documentation['previous']['slug'] === 'index' ? route('docs.show') : route('docs.show', ['path' => $documentation['previous']['slug']]) }}"
                        class="group flex min-h-28 flex-col items-start justify-center gap-2 bg-(--site-surface) p-5 hover:bg-(--site-elevated) focus-visible:z-10 focus-visible:outline-2 focus-visible:outline-(--site-focus) sm:p-6"
                    >
                        <span class="font-mono text-xs uppercase tracking-[0.12em] text-(--site-muted)">← Previous</span>
                        <span class="font-semibold text-(--site-heading)">{{ $documentation['previous']['title'] }}</span>
                    </a>
                @else
                    <div class="hidden bg-(--site-surface) sm:block" aria-hidden="true"></div>
                @endif

                @if ($documentation['next'] !== null)
                    <a
                        href="{{ route('docs.show', ['path' => $documentation['next']['slug']]) }}"
                        class="group flex min-h-28 flex-col items-start justify-center gap-2 bg-(--site-surface) p-5 hover:bg-(--site-elevated) focus-visible:z-10 focus-visible:outline-2 focus-visible:outline-(--site-focus) sm:items-end sm:p-6 sm:text-right"
                    >
                        <span class="font-mono text-xs uppercase tracking-[0.12em] text-(--site-muted)">Next →</span>
                        <span class="font-semibold text-(--site-heading)">{{ $documentation['next']['title'] }}</span>
                    </a>
                @endif
            </nav>

            <p class="mt-8 flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-(--site-muted)">
                <span class="size-1.5 rounded-full bg-(--site-primary)" aria-hidden="true"></span>
                Served from
                <a href="https://github.com/firstlightui/nativephp/tree/main/docs" class="font-medium text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">firstlightui/nativephp</a>
                and cached for a fast first read.
            </p>
        </div>
    </div>
</x-layouts.app>
