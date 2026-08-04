<x-layouts.app
    title="Firstlight UI — Native controls for NativePHP"
    description="Build device-native interfaces for NativePHP with familiar Blade syntax and genuine SwiftUI and Jetpack Compose controls."
>
    <section class="relative py-16 sm:py-24 lg:py-32">
        <div class="pointer-events-none absolute inset-0 technical-grid" aria-hidden="true"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-6 lg:grid-cols-[13fr_11fr] lg:px-8">
            <div class="hero-reveal flex min-w-0 flex-col items-start gap-8">
                <div class="flex flex-col items-start gap-5">
                    <p class="font-mono text-base uppercase tracking-wide text-(--site-primary) sm:text-sm">
                        Built on <a href="https://nativephp.com" class="rounded-sm underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">NativePHP SuperNative</a>
                    </p>
                    <h1 class="max-w-[11ch] text-6xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-7xl lg:text-[5.75rem]">
                        More native UI. Same Blade.
                    </h1>
                    <p class="max-w-[48ch] text-xl text-pretty text-(--site-muted)">
                        Firstlight expands the controls available to NativePHP mobile apps. It builds on the SuperNative foundation created by <a href="https://github.com/shanerbaner82" class="font-medium text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">Shane Rosenthal</a> and <a href="https://github.com/simonhamp" class="font-medium text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">Simon Hamp</a> to bring more genuine SwiftUI and Jetpack Compose controls to familiar Blade syntax.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-x-5 gap-y-3">
                    <a
                        href="#quickstart"
                        class="rounded-full bg-(--site-primary) px-4 py-3 text-base font-semibold text-(--site-on-primary) ring-1 ring-(--site-primary) hover:bg-(--site-primary-hover) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus) active:translate-y-px sm:text-sm"
                    >
                        Start with Firstlight
                    </a>
                    <a
                        href="#components"
                        class="rounded-sm py-3 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm"
                    >
                        Explore current components →
                    </a>
                </div>

                <dl class="grid w-full grid-cols-2 gap-x-6 gap-y-4 border-t border-(--site-border) pt-6 sm:grid-cols-4">
                    <div class="flex flex-col gap-1">
                        <dt class="text-base text-(--site-muted) sm:text-sm">Authoring</dt>
                        <dd class="font-medium text-(--site-heading)">Blade + EDGE</dd>
                    </div>
                    <div class="flex flex-col gap-1">
                        <dt class="text-base text-(--site-muted) sm:text-sm">iOS</dt>
                        <dd class="font-medium text-(--site-heading)">SwiftUI</dd>
                    </div>
                    <div class="flex flex-col gap-1">
                        <dt class="text-base text-(--site-muted) sm:text-sm">Android</dt>
                        <dd class="font-medium text-(--site-heading)">Compose</dd>
                    </div>
                    <div class="flex flex-col gap-1">
                        <dt class="text-base text-(--site-muted) sm:text-sm">State</dt>
                        <dd class="font-medium text-(--site-heading)">PHP-owned</dd>
                    </div>
                </dl>
            </div>

            <div class="hero-reveal-late relative min-h-[34rem] overflow-hidden rounded-[min(4vw,var(--radius-panel))] p-4 ring-1 ring-(--site-border) dawn-field sm:p-6 lg:min-h-[42rem]" aria-label="A Firstlight Blade component rendered as native iOS and Android controls">
                <div class="absolute inset-0 technical-grid opacity-45" aria-hidden="true"></div>

                <div class="relative rounded-[calc(var(--radius-panel)-0.5rem)] bg-(--site-code) p-5 shadow-2xl ring-1 ring-(--site-border) dark:shadow-none sm:p-6">
                    <div class="flex items-center justify-between gap-4 border-b border-white/10 pb-4">
                        <p class="font-mono text-base text-(--site-code-muted) sm:text-sm">queue.blade.php</p>
                        <p class="font-mono text-base text-(--site-code-muted) sm:text-sm">EDGE</p>
                    </div>
                    <pre class="overflow-x-auto pt-5 font-mono text-base text-(--site-code-text) sm:text-sm"><code><span class="text-(--site-code-keyword)">&lt;firstlight:segmented</span>
    :options=<span class="text-(--site-code-string)">"$queues"</span>
    native:model=<span class="text-(--site-code-string)">"queue"</span>
    label=<span class="text-(--site-code-string)">"Queue"</span>
<span class="text-(--site-code-keyword)">/&gt;</span></code></pre>
                </div>

                <div class="absolute right-4 bottom-5 left-4 grid grid-cols-2 gap-3 sm:right-6 sm:bottom-6 sm:left-6 sm:gap-5" aria-hidden="true">
                    <div class="-rotate-2 rounded-[min(4vw,2rem)] bg-[oklch(0.98_0.006_255)] p-4 text-[oklch(0.22_0.03_255)] shadow-2xl ring-1 ring-black/10 dark:shadow-none sm:p-5">
                        <div class="flex items-center justify-between gap-3 border-b border-black/8 pb-3">
                            <p class="font-medium">iOS</p>
                            <p class="font-mono text-sm text-[oklch(0.46_0.025_255)]">SwiftUI</p>
                        </div>
                        <div class="flex flex-col gap-3 pt-5">
                            <p class="font-semibold">Queue</p>
                            <div class="grid grid-cols-2 rounded-full bg-[oklch(0.9_0.01_255)] p-1">
                                <span class="rounded-full bg-[oklch(0.55_0.18_29)] px-2 py-2 text-center font-medium text-[oklch(0.98_0.01_70)]">Mine</span>
                                <span class="px-2 py-2 text-center">All</span>
                            </div>
                        </div>
                    </div>

                    <div class="rotate-2 translate-y-6 rounded-[min(4vw,2rem)] bg-[oklch(0.97_0.008_85)] p-4 text-[oklch(0.21_0.03_58)] shadow-2xl ring-1 ring-black/10 dark:shadow-none sm:p-5">
                        <div class="flex items-center justify-between gap-3 border-b border-black/8 pb-3">
                            <p class="font-medium">Android</p>
                            <p class="font-mono text-sm text-[oklch(0.45_0.03_58)]">Compose</p>
                        </div>
                        <div class="flex flex-col gap-3 pt-5">
                            <p class="font-semibold">Queue</p>
                            <div class="grid grid-cols-2 overflow-hidden rounded-full ring-1 ring-[oklch(0.55_0.18_29)]">
                                <span class="bg-[oklch(0.55_0.18_29)] px-2 py-2.5 text-center font-medium text-[oklch(0.98_0.01_70)]">✓ Mine</span>
                                <span class="px-2 py-2.5 text-center">All</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="why-firstlight" class="border-y border-(--site-border) bg-(--site-surface) py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex flex-col gap-5">
                <p class="font-mono text-base uppercase tracking-wide text-(--site-primary) sm:text-sm">Stay in your stack</p>
                <h2 class="max-w-[18ch] text-4xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-5xl">
                    Go further with the native stack you already know.
                </h2>
                <p class="max-w-[56ch] text-lg text-pretty text-(--site-muted)">
                    SuperNative made device-native UI possible from Blade. Firstlight stays inside that model, widening the component range while each platform keeps its own expression.
                </p>
            </div>

            <dl class="mt-16 grid gap-0 md:grid-cols-3">
                <div class="flex flex-col gap-4 border-t border-(--site-border) py-8 md:border-t-0 md:border-r md:py-0 md:pr-8">
                    <dt class="text-xl font-semibold text-(--site-heading)">Familiar at the source</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        Compose controls with Blade tags, Laravel properties, and NativePHP events. No parallel state model to learn.
                    </dd>
                </div>
                <div class="flex flex-col gap-4 border-t border-(--site-border) py-8 md:border-t-0 md:border-r md:px-8 md:py-0">
                    <dt class="text-xl font-semibold text-(--site-heading)">Authentic on the device</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        iOS uses genuine SwiftUI and UIKit controls. Android uses genuine Material 3 and Jetpack Compose controls.
                    </dd>
                </div>
                <div class="flex flex-col gap-4 border-y border-(--site-border) py-8 md:border-y-0 md:py-0 md:pl-8">
                    <dt class="text-xl font-semibold text-(--site-heading)">Reliable across platforms</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        Shared semantics, paired renderers, accessibility evidence, and server-authoritative reconciliation keep behaviour predictable.
                    </dd>
                </div>
            </dl>
        </div>
    </section>

    <section id="components" class="py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid items-end gap-8 lg:grid-cols-[13fr_11fr] lg:gap-12">
                <div class="flex flex-col gap-5">
                    <p class="font-mono text-base uppercase tracking-wide text-(--site-primary) sm:text-sm">Current components</p>
                    <h2 class="max-w-[18ch] text-4xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-5xl">
                        Small catalogue. Deep native quality.
                    </h2>
                </div>
                <p class="max-w-[56ch] text-lg text-pretty text-(--site-muted)">
                    Firstlight is preparing its public alpha one paired control at a time. Every component must meet the same API, platform, and accessibility standard before it ships.
                </p>
            </div>

            <div class="mt-16 overflow-hidden rounded-[min(3vw,var(--radius-panel))] bg-(--site-elevated) ring-1 ring-(--site-border)">
                <div class="grid lg:grid-cols-[13fr_11fr]">
                    <div class="flex flex-col gap-10 p-6 sm:p-10 lg:p-12">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-baseline gap-3">
                                <h3 class="text-2xl font-semibold tracking-tight text-(--site-heading)">
                                    <a href="https://github.com/firstlightui/nativephp/blob/main/docs/components/segmented.md" class="rounded-sm underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">Segmented</a>
                                </h3>
                                <p class="rounded-full bg-dawn-100 px-3 py-1 text-base font-medium text-dawn-800 dark:bg-dawn-900 dark:text-dawn-200 sm:text-sm">Available</p>
                            </div>
                            <p class="font-mono text-base text-(--site-muted) sm:text-sm">firstlight:segmented</p>
                        </div>

                        <div class="flex flex-col gap-3">
                            <p class="font-medium text-(--site-heading)">Queue</p>
                            <div class="grid grid-cols-2 overflow-hidden rounded-full bg-(--site-recessed) p-1 ring-1 ring-(--site-border-strong)">
                                <span class="rounded-full bg-(--site-primary) px-3 py-2.5 text-center font-medium text-(--site-on-primary)">Mine</span>
                                <span class="px-3 py-2.5 text-center text-(--site-muted)">All</span>
                            </div>
                            <p class="text-base text-(--site-muted) sm:text-sm">Choose the active queue.</p>
                        </div>

                        <dl class="grid gap-6 border-t border-(--site-border) pt-8 sm:grid-cols-2">
                            <div class="flex flex-col gap-2">
                                <dt class="font-medium text-(--site-heading)">iOS expression</dt>
                                <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">SwiftUI field composition backed by UISegmentedControl.</dd>
                            </div>
                            <div class="flex flex-col gap-2">
                                <dt class="font-medium text-(--site-heading)">Android expression</dt>
                                <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">Material 3 SingleChoiceSegmentedButtonRow.</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="flex flex-col justify-between gap-12 bg-(--site-recessed) p-6 sm:p-10 lg:p-12">
                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline justify-between gap-4">
                                <h3 class="text-2xl font-semibold tracking-tight text-(--site-heading)">Status Label</h3>
                                <p class="font-mono text-base text-(--site-muted) sm:text-sm">In alpha</p>
                            </div>
                            <p class="max-w-[48ch] text-base text-pretty text-(--site-muted) sm:text-sm">
                                Display-only semantic metadata with native text scaling and contrast-safe theme tokens.
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center gap-3" aria-label="Status Label tone examples">
                            <span class="rounded-full bg-(--site-elevated) px-3 py-2 font-medium text-(--site-heading) ring-1 ring-(--site-border)">Neutral</span>
                            <span class="rounded-full bg-[oklch(0.9_0.08_85)] px-3 py-2 font-medium text-[oklch(0.32_0.08_70)] dark:bg-[oklch(0.3_0.07_70)] dark:text-[oklch(0.9_0.08_85)]">Awaiting review</span>
                            <span class="rounded-full bg-[oklch(0.9_0.08_145)] px-3 py-2 font-medium text-[oklch(0.3_0.09_145)] dark:bg-[oklch(0.3_0.07_145)] dark:text-[oklch(0.9_0.08_145)]">Ready</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-(--site-border) bg-(--site-code) py-20 text-(--site-code-text) sm:py-28">
        <div class="mx-auto grid max-w-7xl items-start gap-12 px-6 lg:grid-cols-[13fr_11fr] lg:px-8">
            <div class="flex flex-col gap-6">
                <p class="font-mono text-base uppercase tracking-wide text-(--site-code-keyword) sm:text-sm">Firstlight on SuperNative</p>
                <h2 class="max-w-[18ch] text-4xl font-semibold tracking-tight text-balance sm:text-5xl">
                    NativePHP laid the foundation. Firstlight extends the range.
                </h2>
                <p class="max-w-[56ch] text-lg text-pretty text-(--site-code-muted)">
                    Firstlight participates in the EDGE, Element Tree, shared-memory frame, renderer, and wire-event lifecycle created for SuperNative. Ordinary interaction stays on the native UI thread.
                </p>
            </div>

            <dl class="divide-y divide-white/10 border-y border-white/10">
                <div class="grid grid-cols-[auto_1fr] gap-x-5 py-5">
                    <dt class="font-mono text-base text-(--site-code-keyword) sm:text-sm">01</dt>
                    <dd class="text-base text-pretty text-(--site-code-text) sm:text-sm">Blade compiles to a Firstlight element with stable public values.</dd>
                </div>
                <div class="grid grid-cols-[auto_1fr] gap-x-5 py-5">
                    <dt class="font-mono text-base text-(--site-code-keyword) sm:text-sm">02</dt>
                    <dd class="text-base text-pretty text-(--site-code-text) sm:text-sm">The shared element tree publishes primitive, platform-neutral intent.</dd>
                </div>
                <div class="grid grid-cols-[auto_1fr] gap-x-5 py-5">
                    <dt class="font-mono text-base text-(--site-code-keyword) sm:text-sm">03</dt>
                    <dd class="text-base text-pretty text-(--site-code-text) sm:text-sm">SwiftUI and Compose renderers express that intent natively.</dd>
                </div>
            </dl>
        </div>
    </section>

    <section id="quickstart" class="py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="rounded-[min(3vw,var(--radius-panel))] bg-(--site-surface) p-6 ring-1 ring-(--site-border) sm:p-10 lg:p-12">
                <div class="grid min-w-0 grid-cols-1 items-end gap-12 lg:grid-cols-[13fr_11fr]">
                    <div class="flex min-w-0 flex-col gap-6">
                        <p class="font-mono text-base uppercase tracking-wide text-(--site-primary) sm:text-sm">Quickstart</p>
                        <h2 class="max-w-[18ch] text-4xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-5xl">
                            Add native range without leaving Laravel.
                        </h2>
                        <p class="max-w-[56ch] text-lg text-pretty text-(--site-muted)">
                            Install the package, register its native renderers, and author your first Firstlight component with Blade.
                        </p>
                    </div>

                    <div class="flex min-w-0 flex-col gap-4">
                        <div class="flex min-w-0 items-center gap-3 rounded-xl bg-(--site-code) p-3 ring-1 ring-(--site-border)">
                            <code class="min-w-0 flex-1 overflow-x-auto px-1 font-mono text-base whitespace-nowrap text-(--site-code-text) sm:text-sm" data-copy-source="install-command">composer require firstlightui/nativephp</code>
                            <button
                                type="button"
                                class="relative shrink-0 rounded-lg bg-white/8 px-3 py-2 text-base font-medium text-(--site-code-text) ring-1 ring-white/12 hover:bg-white/12 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus) sm:text-sm"
                                data-copy-target="install-command"
                            >
                                <span class="pointer-fine:hidden absolute top-1/2 left-1/2 size-[max(100%,3rem)] -translate-1/2" aria-hidden="true"></span>
                                <span aria-live="polite" data-copy-label>Copy</span>
                            </button>
                        </div>
                        <a href="https://github.com/firstlightui/nativephp/blob/main/docs/getting-started/installation.md" class="self-start rounded-sm py-2 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm" target="_blank" rel="noreferrer">
                            Read the getting started guide →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
