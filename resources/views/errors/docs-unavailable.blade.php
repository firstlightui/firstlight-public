<x-layouts.app
    title="Documentation temporarily unavailable — Firstlight UI"
    description="Firstlight UI documentation is temporarily unavailable."
    main-class="isolate"
>
    <section class="relative min-h-[68dvh] overflow-hidden">
        <div class="pointer-events-none absolute inset-0 technical-grid opacity-60" aria-hidden="true"></div>

        <div class="relative mx-auto flex max-w-3xl flex-col items-start gap-7 px-6 py-24 sm:py-32 lg:px-8">
            <p class="font-mono text-sm uppercase tracking-[0.12em] text-(--site-primary)">Docs / Signal interrupted</p>
            <h1 class="max-w-[14ch] text-5xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-6xl">The source is taking a moment.</h1>
            <p class="max-w-[52ch] text-lg text-pretty text-(--site-muted)">
                Firstlight reads its documentation from GitHub. The cached copy is not available yet, so please try again shortly or read the source directly.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('docs.show') }}" class="rounded-full bg-(--site-primary) px-4 py-3 text-sm font-semibold text-(--site-on-primary) hover:bg-(--site-primary-hover) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)">Try again</a>
                <a href="https://github.com/firstlightui/nativephp/tree/main/docs" class="rounded-full px-4 py-3 text-sm font-semibold text-(--site-heading) ring-1 ring-(--site-border-strong) hover:bg-(--site-surface) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">Open GitHub docs ↗</a>
            </div>
        </div>
    </section>
</x-layouts.app>
