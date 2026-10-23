@inject('structuredData', 'App\\StructuredData')

<x-layouts.app
    title="Firstlight UI — Native-first building blocks for NativePHP"
    description="Add Laravel validate(), submit(), and Gate-backed authorize() on native screens, plus a curated form layer on NativePHP Mobile UI."
    :schema="$structuredData->home()"
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
                        Native by platform. Familiar in Blade.
                    </h1>
                    <p class="max-w-[48ch] text-xl text-pretty text-(--site-muted)">
                        Firstlight is a curated form and control layer for NativePHP Mobile UI. It builds on Mobile UI’s official SwiftUI and Jetpack Compose foundation, adding stable values, consistent field semantics, Laravel <code class="font-mono text-[0.95em]">validate()</code>, <code class="font-mono text-[0.95em]">submit()</code>, and Gate-backed <code class="font-mono text-[0.95em]">authorize()</code> on native screens, and server-authoritative state through familiar Blade components. NativePHP EDGE does not ship those PHP helpers; Firstlight does. It runs on the SuperNative foundation created by <a href="https://github.com/shanerbaner82" class="font-medium text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">Shane Rosenthal</a> and <a href="https://github.com/simonhamp" class="font-medium text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">Simon Hamp</a>.
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
                <p class="font-mono text-base uppercase tracking-wide text-(--site-primary) sm:text-sm">Built on NativePHP Mobile UI</p>
                <h2 class="max-w-[18ch] text-4xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-5xl">
                    A focused control layer for the native toolkit.
                </h2>
                <p class="max-w-[56ch] text-lg text-pretty text-(--site-muted)">
                    <a href="https://nativephp.com" class="font-medium text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">NativePHP Mobile UI</a> provides the comprehensive native foundation for NativePHP applications. Firstlight builds on it with a smaller, opinionated catalogue for teams that want common form behaviour decided once and reused consistently.
                </p>
                <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                    <a href="{{ route('comparison') }}" class="rounded-sm py-2 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">Firstlight vs NativePHP Mobile UI →</a>
                    <a href="{{ route('docs.show', ['path' => 'concepts/firstlight-and-mobile-ui']) }}" class="rounded-sm py-2 text-base font-normal text-(--site-muted) underline decoration-(--site-border-strong) underline-offset-4 hover:text-(--site-heading) hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">Read the concept guide</a>
                </div>
            </div>

            <dl class="mt-16 grid gap-0 md:grid-cols-3">
                <div class="flex flex-col gap-4 border-t border-(--site-border) py-8 md:border-t-0 md:border-r md:py-0 md:pr-8">
                    <dt class="text-xl font-semibold text-(--site-heading)">Familiar at the source</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        Compose controls with Blade tags, Laravel properties, and NativePHP events. No parallel state model to learn.
                    </dd>
                </div>
                <div class="flex flex-col gap-4 border-t border-(--site-border) py-8 md:border-t-0 md:border-r md:px-8 md:py-0">
                    <dt class="text-xl font-semibold text-(--site-heading)">NativePHP all the way down</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        Firstlight uses Mobile UI’s ordinary component extension points, inherits its semantic theme, and follows the same SwiftUI and Material 3 approach.
                    </dd>
                </div>
                <div class="flex flex-col gap-4 border-y border-(--site-border) py-8 md:border-y-0 md:py-0 md:pl-8">
                    <dt class="text-xl font-semibold text-(--site-heading)">Laravel SuperNative extensions</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        NativePHP has no screen-level <code class="font-mono text-[0.95em]">validate()</code>, guarded <code class="font-mono text-[0.95em]">submit()</code>, or Gate-backed <code class="font-mono text-[0.95em]">authorize()</code>. Firstlight adds those PHP contracts on native fields and actions.
                    </dd>
                </div>
            </dl>
        </div>
    </section>

    <section id="extensions" class="py-20 sm:py-24">
        <span id="validation"></span>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex flex-col gap-5">
                <p class="font-mono text-base uppercase tracking-wide text-(--site-primary) sm:text-sm">Laravel SuperNative extensions</p>
                <h2 class="max-w-[18ch] text-4xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-5xl">
                    NativePHP publishes a tree. Firstlight adds Laravel around it.
                </h2>
                <p class="max-w-[56ch] text-lg text-pretty text-(--site-muted)">
                    NativePHP EDGE has no screen-level <code class="font-mono text-[0.95em]">validate()</code>, no once-run submit helper, and no Gate-backed action guard. Failed rules, double presses, and unauthorized mutations still fall through to sibling text or the generic overlay. Firstlight adds three PHP concerns on <code class="font-mono text-[0.95em]">NativeComponent</code>: <code class="font-mono text-[0.95em]">ValidatesFields</code>, <code class="font-mono text-[0.95em]">SubmitsForms</code>, and <code class="font-mono text-[0.95em]">AuthorizesActions</code>.
                </p>
            </div>

            <dl class="mt-16 grid gap-0 lg:grid-cols-3">
                <div class="flex flex-col gap-4 border-t border-(--site-border) py-8 lg:border-t-0 lg:border-r lg:py-0 lg:pr-8">
                    <dt class="text-xl font-semibold text-(--site-heading)">Validate</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        NativePHP has no <code class="font-mono text-[0.95em]">validate()</code>. <code class="font-mono text-[0.95em]">@@nativeError</code> is sibling text, and a thrown <code class="font-mono text-[0.95em]">ValidationException</code> still hits the overlay. Firstlight binds the first MessageBag message to the field’s native error slot.
                    </dd>
                    <dd class="rounded-[calc(var(--radius-panel)-0.5rem)] bg-(--site-code) p-5 ring-1 ring-(--site-border)">
                        <pre class="overflow-x-auto font-mono text-base text-(--site-code-text) sm:text-sm"><code><span class="text-(--site-code-keyword)">$this</span>->validate();</code></pre>
                    </dd>
                </div>
                <div class="flex flex-col gap-4 border-t border-(--site-border) py-8 lg:border-t-0 lg:border-r lg:px-8 lg:py-0">
                    <dt class="text-xl font-semibold text-(--site-heading)">Submit</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        A NativePHP press is just a PHP method. Firstlight <code class="font-mono text-[0.95em]">submit()</code> validates, runs the callable once, optionally sends success Feedback, and guards re-entry on the same request.
                    </dd>
                    <dd class="rounded-[calc(var(--radius-panel)-0.5rem)] bg-(--site-code) p-5 ring-1 ring-(--site-border)">
                        <pre class="overflow-x-auto font-mono text-base text-(--site-code-text) sm:text-sm"><code><span class="text-(--site-code-keyword)">$this</span>->submit(
    action: fn () => $profile->save(),
    successMessage: <span class="text-(--site-code-string)">'Saved'</span>,
);</code></pre>
                    </dd>
                </div>
                <div class="flex flex-col gap-4 border-y border-(--site-border) py-8 lg:border-y-0 lg:py-0 lg:pl-8">
                    <dt class="text-xl font-semibold text-(--site-heading)">Authorize</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        NativePHP has no Gate helpers on screens. An uncaught authorization exception still opens the overlay. Firstlight <code class="font-mono text-[0.95em]">allows()</code>, <code class="font-mono text-[0.95em]">denies()</code>, and <code class="font-mono text-[0.95em]">authorize()</code> hide, disable, or send danger Feedback instead.
                    </dd>
                    <dd class="rounded-[calc(var(--radius-panel)-0.5rem)] bg-(--site-code) p-5 ring-1 ring-(--site-border)">
                        <pre class="overflow-x-auto font-mono text-base text-(--site-code-text) sm:text-sm"><code><span class="text-(--site-code-keyword)">if</span> (! <span class="text-(--site-code-keyword)">$this</span>->authorize(<span class="text-(--site-code-string)">'update'</span>, $post)) {
    <span class="text-(--site-code-keyword)">return</span>;
}</code></pre>
                    </dd>
                </div>
            </dl>

            <div class="mt-12 grid gap-8 sm:grid-cols-2">
                <a href="{{ route('docs.show', ['path' => 'how-to/validate-fields']) }}" class="group flex flex-col items-start gap-3 rounded-(--radius-panel) bg-(--site-surface) p-6 ring-1 ring-(--site-border) hover:bg-(--site-elevated) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)">
                    <p class="font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-primary)">How-to</p>
                    <p class="text-xl font-semibold text-(--site-heading)">Validate fields</p>
                    <p class="text-base text-pretty text-(--site-muted) sm:text-sm">Use validate(), validateOnly(), and Form Requests so Laravel messages land on native fields.</p>
                    <span class="pt-2 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 group-hover:decoration-(--site-primary) sm:text-sm">Read the validation guide →</span>
                </a>
                <a href="{{ route('docs.show', ['path' => 'how-to/submit-forms']) }}" class="group flex flex-col items-start gap-3 rounded-(--radius-panel) bg-(--site-surface) p-6 ring-1 ring-(--site-border) hover:bg-(--site-elevated) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)">
                    <p class="font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-primary)">How-to</p>
                    <p class="text-xl font-semibold text-(--site-heading)">Submit forms</p>
                    <p class="text-base text-pretty text-(--site-muted) sm:text-sm">Validate, run a PHP action once, and publish success Feedback without a form schema or overlay.</p>
                    <span class="pt-2 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 group-hover:decoration-(--site-primary) sm:text-sm">Read the submit guide →</span>
                </a>
                <a href="{{ route('docs.show', ['path' => 'how-to/authorize-actions']) }}" class="group flex flex-col items-start gap-3 rounded-(--radius-panel) bg-(--site-surface) p-6 ring-1 ring-(--site-border) hover:bg-(--site-elevated) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)">
                    <p class="font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-primary)">How-to</p>
                    <p class="text-xl font-semibold text-(--site-heading)">Authorize actions</p>
                    <p class="text-base text-pretty text-(--site-muted) sm:text-sm">Apply Laravel Gate and Policy decisions with hide, disable, and danger Feedback instead of the overlay.</p>
                    <span class="pt-2 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 group-hover:decoration-(--site-primary) sm:text-sm">Read the authorization guide →</span>
                </a>
                <a href="{{ route('docs.show', ['path' => 'concepts/firstlight-and-mobile-ui']) }}" class="group flex flex-col items-start gap-3 rounded-(--radius-panel) bg-(--site-surface) p-6 ring-1 ring-(--site-border) hover:bg-(--site-elevated) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)">
                    <p class="font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-primary)">Concept</p>
                    <p class="text-xl font-semibold text-(--site-heading)">How Firstlight complements NativePHP Mobile UI</p>
                    <p class="text-base text-pretty text-(--site-muted) sm:text-sm">See the focused form layer and Laravel-shaped PHP extensions Firstlight adds on Mobile UI.</p>
                    <span class="pt-2 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 group-hover:decoration-(--site-primary) sm:text-sm">Read how the catalogues fit →</span>
                </a>
            </div>
        </div>
    </section>

    <section id="components" class="py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid items-end gap-8 lg:grid-cols-[13fr_11fr] lg:gap-12">
                <div class="flex flex-col gap-5">
                    <p class="font-mono text-base uppercase tracking-wide text-(--site-primary) sm:text-sm">Current components</p>
                    <h2 class="max-w-[18ch] text-4xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-5xl">
                        Curated controls. Consistent contracts.
                    </h2>
                </div>
                <p class="max-w-[56ch] text-lg text-pretty text-(--site-muted)">
                    Firstlight focuses on form, selection, display, and action controls with stable values, strict validation, and consistent field semantics. The catalogue grows where a reusable product-level contract saves every app from solving the same problem again.
                </p>
            </div>

            <div class="mt-16" data-component-catalogue>
                <div class="mb-4 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <span class="font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-muted)">Component gallery</span>
                        <span class="font-mono text-xs text-(--site-muted)" aria-live="polite" data-component-catalogue-current>1 / {{ count(config('component-gallery.components', [])) }}</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('components.index') }}" class="rounded-sm py-2 text-sm font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">View all components</a>
                        <div class="flex items-center gap-1">
                            <button
                                type="button"
                                class="grid size-11 place-items-center rounded-full text-(--site-heading) ring-1 ring-(--site-border-strong) hover:bg-(--site-surface) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus) disabled:cursor-not-allowed disabled:opacity-30"
                                aria-label="Previous component"
                                data-component-catalogue-previous
                            >
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                            </button>
                            <button
                                type="button"
                                class="grid size-11 place-items-center rounded-full text-(--site-heading) ring-1 ring-(--site-border-strong) hover:bg-(--site-surface) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus) disabled:cursor-not-allowed disabled:opacity-30"
                                aria-label="Next component"
                                data-component-catalogue-next
                            >
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    class="component-catalogue-track flex snap-x snap-mandatory overflow-x-auto scroll-smooth focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) motion-reduce:scroll-auto"
                    tabindex="0"
                    aria-label="Firstlight components"
                    data-component-catalogue-track
                >
                    @foreach (config('component-gallery.components', []) as $component)
                        <div class="min-w-full snap-start p-px" data-component-catalogue-slide>
                            <x-component-gallery-card :gallery-component="$component" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-(--site-border) bg-(--site-code) py-20 text-(--site-code-text) sm:py-28">
        <div class="mx-auto grid max-w-7xl items-start gap-12 px-6 lg:grid-cols-[13fr_11fr] lg:px-8">
            <div class="flex flex-col gap-6">
                <p class="font-mono text-base uppercase tracking-wide text-(--site-code-keyword) sm:text-sm">Firstlight in the NativePHP ecosystem</p>
                <h2 class="max-w-[18ch] text-4xl font-semibold tracking-tight text-balance sm:text-5xl">
                    SuperNative supplies the bridge. Firstlight adds consistent product contracts.
                </h2>
                <p class="max-w-[56ch] text-lg text-pretty text-(--site-code-muted)">
                    Firstlight uses the same EDGE, Element Tree, shared-memory frame, renderer, theme, and event lifecycle as NativePHP Mobile UI. Ordinary interaction stays on the native UI thread.
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
                            Add consistent form contracts without leaving NativePHP.
                        </h2>
                        <p class="max-w-[56ch] text-lg text-pretty text-(--site-muted)">
                            Requires NativePHP Mobile <code class="font-mono text-[0.95em]">^4.6</code> and Mobile UI <code class="font-mono text-[0.95em]">^0.8</code>.
                        </p>
                        <p class="max-w-[56ch] text-base text-pretty text-(--site-muted)">
                            Build your screens with <code class="font-mono text-[0.95em]">FirstlightUI\NativeComponent</code> and use Firstlight controls in Blade.
                        </p>
                    </div>

                    <div class="flex min-w-0 flex-col gap-4">
                        <div class="flex min-w-0 items-center gap-3 rounded-xl bg-(--site-code) p-3 ring-1 ring-(--site-border)">
                            <code class="min-w-0 flex-1 overflow-x-auto px-1 font-mono text-base whitespace-nowrap text-(--site-code-text) sm:text-sm" data-copy-source="install-command">composer require "firstlightui/nativephp:^1.0@RC"</code>
                            <button
                                type="button"
                                class="relative shrink-0 rounded-lg bg-white/8 px-3 py-2 text-base font-medium text-(--site-code-text) ring-1 ring-white/12 hover:bg-white/12 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus) sm:text-sm"
                                data-copy-target="install-command"
                            >
                                <span class="pointer-fine:hidden absolute top-1/2 left-1/2 size-[max(100%,3rem)] -translate-1/2" aria-hidden="true"></span>
                                <span aria-live="polite" data-copy-label>Copy</span>
                            </button>
                        </div>
                        <a href="{{ route('docs.show', ['path' => 'getting-started/installation']) }}" class="self-start rounded-sm py-2 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">
                            Read the getting started guide →
                        </a>
                        <p class="text-base text-pretty text-(--site-muted) sm:text-sm">
                            Firstlight 1.0.0 is a release candidate. Use it for evaluation, not production. Testing on real phones, long-running performance tests and use in more apps are still pending. Read the
                            <a href="{{ route('docs.show', ['path' => 'reference/compatibility']) }}" class="rounded-sm underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">compatibility notes</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
