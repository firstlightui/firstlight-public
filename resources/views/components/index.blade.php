<x-layouts.app
    title="Firstlight UI components — Native-first alternatives for NativePHP"
    description="Explore Firstlight’s native-first alternative component implementations and app building blocks for NativePHP."
    main-class="isolate"
>
    <section class="border-b border-(--site-border) bg-(--site-surface) py-16 sm:py-20">
        <div class="mx-auto grid max-w-7xl items-end gap-8 px-6 lg:grid-cols-[13fr_11fr] lg:px-8">
            <div class="flex flex-col gap-5">
                <p class="font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-primary)">Component catalogue</p>
                <h1 class="max-w-[16ch] text-5xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-6xl">Native-first alternatives, in familiar Blade.</h1>
            </div>
            <p class="max-w-[54ch] text-lg text-pretty text-(--site-muted)">Firstlight wraps familiar NativePHP patterns, offers alternative implementations where platform-native expression matters, and provides a base for richer app building blocks.</p>
        </div>
    </section>

    <section class="py-16 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-4 px-6 lg:grid-cols-12 lg:px-8">
            @foreach (config('component-gallery.components', []) as $component)
                <x-component-index-card :gallery-component="$component" />
            @endforeach
        </div>
    </section>
</x-layouts.app>
