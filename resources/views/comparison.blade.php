@inject('structuredData', 'App\\StructuredData')

@php
    $faqs = [
        [
            'question' => 'Does Firstlight UI replace NativePHP Mobile UI?',
            'answer' => 'No. Firstlight is installed alongside NativePHP Mobile UI and depends on it. Mobile UI supplies the native foundation — the EDGE element tree, the SwiftUI and Jetpack Compose renderers, the semantic theme, and the event lifecycle. Firstlight adds a curated form and control layer on top of it.',
        ],
        [
            'question' => 'What does Firstlight add that NativePHP does not have?',
            'answer' => 'Consistent controls and screen-level PHP helpers. At the control level, every Firstlight component exposes a stable public value and the same field semantics — label, value, error, disabled, and required behave identically across text fields, selects, pickers, sliders, and choice groups, so a form does not need per-control special cases. At the screen level, NativePHP EDGE has no validate(), no once-run submit helper, and no Gate-backed action guard; Firstlight adds ValidatesFields, SubmitsForms, and AuthorizesActions, so validation messages bind to the native field error slot, submits run once and publish native Feedback, and Gate decisions hide or disable native controls instead of reaching the generic error overlay.',
        ],
        [
            'question' => 'Can I use Firstlight and NativePHP Mobile UI components on the same screen?',
            'answer' => 'Yes. Firstlight is built on Mobile UI’s ordinary component extension points and publishes into the same element tree, so Firstlight and Mobile UI components compose together and share the same theme and event lifecycle.',
        ],
        [
            'question' => 'What do I need to install Firstlight UI?',
            'answer' => 'Use NativePHP Mobile ^4.6 and Mobile UI ^0.8. Install firstlightui/nativephp with Composer, then extend FirstlightUI\\NativeComponent for your screens. The installation guide has the complete setup.',
        ],
        [
            'question' => 'Is Firstlight UI free?',
            'answer' => 'Yes. Firstlight UI is open source and free to use, released under the MIT licence. There is no paid tier.',
        ],
        [
            'question' => 'Why is the Firstlight component catalogue smaller than Mobile UI’s?',
            'answer' => 'By design. Mobile UI aims for comprehensive native coverage. Firstlight is a curated catalogue of 27 form, selection, display, and action controls, and adds a control only when many apps would otherwise build it themselves.',
        ],
        [
            'question' => 'Is Firstlight UI production ready?',
            'answer' => 'No. Firstlight 1.0.0 is a release candidate. It has been tested on an Android emulator and iOS simulator. Testing on real phones, long-running performance tests and use in more apps are still pending. Use it for evaluation, not production; the API may change.',
        ],
    ];
@endphp

<x-layouts.app
    title="Firstlight UI vs NativePHP Mobile UI — how the two catalogues fit together"
    description="Firstlight UI does not replace NativePHP Mobile UI — it installs alongside it and adds Laravel validate(), submit(), and Gate-backed authorize() on native screens. A side-by-side comparison of what each one is responsible for."
    main-class="isolate"
    :schema="$structuredData->comparison(
        'Firstlight UI vs NativePHP Mobile UI',
        'How Firstlight UI and NativePHP Mobile UI differ, what each is responsible for, and why they are installed together.',
        $faqs,
    )"
>
    <section class="border-b border-(--site-border) bg-(--site-surface) py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <p class="font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-primary)">Comparison</p>
            <h1 class="mt-5 max-w-[20ch] text-5xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-6xl">
                Firstlight UI vs NativePHP Mobile UI
            </h1>

            {{-- The direct answer, kept short and self-contained so it stands on its own out of context. --}}
            <p class="mt-8 max-w-[62ch] text-xl text-pretty text-(--site-heading)">
                They are not alternatives. NativePHP Mobile UI is the native foundation; Firstlight UI is a curated form and control layer installed alongside it. Mobile UI renders native controls from Blade. Firstlight adds the Laravel contracts NativePHP does not ship — screen-level <code class="font-mono text-[0.95em]">validate()</code>, a once-run <code class="font-mono text-[0.95em]">submit()</code>, and Gate-backed <code class="font-mono text-[0.95em]">authorize()</code>.
            </p>

            <p class="mt-6 max-w-[62ch] text-base text-pretty text-(--site-muted)">
                You cannot use Firstlight without Mobile UI. The real decision is whether you want form, validation, and authorization behaviour from a package, or written per screen in your own app.
            </p>
        </div>
    </section>

    <section class="py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="max-w-[22ch] text-3xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-4xl">
                What each one is responsible for
            </h2>

            <div class="mt-10 overflow-x-auto rounded-(--radius-panel) ring-1 ring-(--site-border)">
                <table class="w-full min-w-3xl border-collapse text-left">
                    <caption class="sr-only">A comparison of NativePHP Mobile UI and Firstlight UI responsibilities</caption>
                    <thead>
                        <tr class="bg-(--site-surface)">
                            <th scope="col" class="border-b border-(--site-border) px-5 py-4 text-sm font-semibold text-(--site-muted) sm:px-6">Concern</th>
                            <th scope="col" class="border-b border-(--site-border) px-5 py-4 text-sm font-semibold text-(--site-heading) sm:px-6">NativePHP Mobile UI</th>
                            <th scope="col" class="border-b border-(--site-border) px-5 py-4 text-sm font-semibold text-(--site-heading) sm:px-6">Firstlight UI</th>
                        </tr>
                    </thead>
                    <tbody class="text-base sm:text-sm">
                        @foreach ([
                            ['Role', 'The native foundation for NativePHP apps', 'A curated form and control layer on top of it'],
                            ['Relationship', 'Required. Firstlight depends on it', 'Installed alongside Mobile UI, never instead of it'],
                            ['Component coverage', 'Comprehensive native catalogue', 'Curated — 27 form, selection, display, and action controls'],
                            ['Control contracts', 'Each control exposes its own platform-shaped API', 'One contract across every control — stable public value, and the same label, error, disabled, and required semantics'],
                            ['Rendering', 'SwiftUI on iOS, Jetpack Compose on Android', 'The same renderers, via Mobile UI’s extension points'],
                            ['Element tree', 'Publishes the shared EDGE element tree', 'Publishes into that same element tree'],
                            ['Theme', 'Supplies the semantic theme', 'Inherits it — no parallel theme to maintain'],
                            ['Screen-level validate()', 'Not provided', 'ValidatesFields — validate() and validateOnly()'],
                            ['Validation message display', '@nativeError renders as sibling text; a thrown ValidationException reaches the generic overlay', 'Binds the first MessageBag message to the field’s native error slot'],
                            ['Guarded submit', 'A press is an ordinary PHP method; re-entry is yours to handle', 'SubmitsForms — validates, runs the action once, optionally sends success Feedback'],
                            ['Gate-backed authorize()', 'No Gate helpers on screens; an uncaught authorization exception opens the overlay', 'AuthorizesActions — allows(), denies(), authorize() hide, disable, or send danger Feedback'],
                            ['Licence and price', 'See the NativePHP project', 'MIT, free, no paid tier'],
                            ['Maturity', 'The established foundation', 'Release candidate — testing on real phones and in more apps is still pending'],
                        ] as $index => [$concern, $mobileUi, $firstlight])
                            <tr class="{{ $index % 2 === 1 ? 'bg-(--site-surface)' : '' }}">
                                <th scope="row" class="border-b border-(--site-border) px-5 py-4 align-top font-medium text-(--site-heading) sm:px-6">{{ $concern }}</th>
                                <td class="border-b border-(--site-border) px-5 py-4 align-top text-pretty text-(--site-muted) sm:px-6">{{ $mobileUi }}</td>
                                <td class="border-b border-(--site-border) px-5 py-4 align-top text-pretty text-(--site-muted) sm:px-6">{{ $firstlight }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="border-y border-(--site-border) bg-(--site-surface) py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="max-w-[24ch] text-3xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-4xl">
                When to add Firstlight, and when to stay on Mobile UI alone
            </h2>

            <div class="mt-12 grid gap-0 md:grid-cols-2">
                <div class="flex flex-col gap-4 border-t border-(--site-border) py-8 md:border-t-0 md:border-r md:py-0 md:pr-10">
                    <h3 class="text-xl font-semibold text-(--site-heading)">Add Firstlight when</h3>
                    <ul class="flex flex-col gap-3 text-base text-pretty text-(--site-muted)">
                        <li>Your app has real forms, and you are writing the same validation and submit plumbing on every screen.</li>
                        <li>You want Laravel validation messages to land on the native field rather than as sibling text or a generic overlay.</li>
                        <li>You need Gate and Policy decisions to hide or disable native controls consistently.</li>
                        <li>You want field semantics decided once across a codebase or a team.</li>
                    </ul>
                </div>
                <div class="flex flex-col gap-4 border-y border-(--site-border) py-8 md:border-y-0 md:py-0 md:pl-10">
                    <h3 class="text-xl font-semibold text-(--site-heading)">Stay on Mobile UI alone when</h3>
                    <ul class="flex flex-col gap-3 text-base text-pretty text-(--site-muted)">
                        <li>Your app is mostly display and navigation, with few or no forms.</li>
                        <li>You need a native control outside Firstlight’s curated catalogue — reach for Mobile UI directly, and mix the two freely.</li>
                        <li>You need a production-ready package and cannot take a release-candidate dependency.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-3xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-4xl">
                Common questions
            </h2>

            <dl class="mt-10 max-w-[70ch] divide-y divide-(--site-border) border-y border-(--site-border)">
                @foreach ($faqs as $faq)
                    <div class="flex flex-col gap-3 py-7">
                        <dt class="text-xl font-semibold text-pretty text-(--site-heading)">{{ $faq['question'] }}</dt>
                        <dd class="text-base text-pretty text-(--site-muted)">{{ $faq['answer'] }}</dd>
                    </div>
                @endforeach
            </dl>

            <div class="mt-12 flex flex-wrap items-center gap-x-6 gap-y-3">
                <a href="{{ route('docs.show', ['path' => 'getting-started/installation']) }}" class="rounded-full bg-(--site-primary) px-4 py-3 text-base font-semibold text-(--site-on-primary) ring-1 ring-(--site-primary) hover:bg-(--site-primary-hover) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus) active:translate-y-px sm:text-sm">
                    Install Firstlight
                </a>
                <a href="{{ route('docs.show', ['path' => 'concepts/firstlight-and-mobile-ui']) }}" class="rounded-sm py-3 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">
                    Read the concept guide →
                </a>
                <a href="{{ route('docs.show', ['path' => 'reference/compatibility']) }}" class="rounded-sm py-3 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">
                    Compatibility notes →
                </a>
                <a href="https://nativephp.com" class="rounded-sm py-3 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm" target="_blank" rel="noreferrer">
                    NativePHP Mobile UI ↗
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>
