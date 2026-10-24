@inject('structuredData', 'App\\StructuredData')

@php
    $eyebrow = 'font-mono text-base uppercase tracking-wide text-(--site-primary) sm:text-sm';
    $sectionHeading = 'max-w-[20ch] text-4xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-5xl';
    $lead = 'max-w-[58ch] text-lg text-pretty text-(--site-muted)';
    $inlineLink = 'font-medium text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)';
    $textLink = 'rounded-sm py-2 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm';
    $code = 'font-mono text-[0.95em]';
    $card = 'group flex flex-col items-start gap-3 rounded-(--radius-panel) bg-(--site-surface) p-6 ring-1 ring-(--site-border) hover:bg-(--site-elevated) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)';
    $cardEyebrow = 'font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-primary)';
    $cardLink = 'pt-2 text-base font-semibold text-(--site-heading) underline decoration-(--site-border-strong) underline-offset-4 group-hover:decoration-(--site-primary) sm:text-sm';

    $recipes = [
        [
            'path' => 'how-to/build-a-list-detail-flow',
            'step' => '01',
            'title' => 'List and detail flow',
            'summary' => 'The app shell: native title bars and back navigation, a list, and a detail screen it pushes. The other recipes run inside it.',
        ],
        [
            'path' => 'how-to/build-a-searchable-list-screen',
            'step' => '02',
            'title' => 'Searchable list',
            'summary' => 'Native search, a paginated list, pull-to-refresh, row navigation, and swipe-to-delete behind a native confirmation.',
        ],
        [
            'path' => 'how-to/build-a-form-screen',
            'step' => '03',
            'title' => 'Form screen',
            'summary' => 'A Form Request, errors on each native field, a form-level error, a loading Save button, and success feedback.',
        ],
        [
            'path' => 'how-to/build-a-settings-screen',
            'step' => '04',
            'title' => 'Settings screen',
            'summary' => 'Grouped native sections with switches and pickers that save as soon as they change.',
        ],
    ];

    $platformPatterns = [
        ['Tabs', 'Segmented control', 'Material 3 tabs'],
        ['Confirmation Dialog', 'SwiftUI confirmationDialog', 'Material 3 AlertDialog'],
        ['Date Picker', 'Graphical SwiftUI DatePicker', 'Material 3 DatePickerDialog'],
        ['Field error', 'Error text under the field', 'Material 3 supporting text in the error state'],
    ];

    $accessibility = [
        [
            'title' => 'Labels and actions for VoiceOver and TalkBack',
            'body' => 'Icon-only controls refuse to render without an accessible name, and fields warn in development without one. A row or a field is one focus stop, and every swipe and context-menu action is also a screen-reader action.',
        ],
        [
            'title' => 'Validation errors are spoken',
            'body' => 'A failed submit reads its errors aloud once, then moves screen-reader focus to the first invalid field. A field that fails on blur reads only its own message.',
        ],
        [
            'title' => 'Text grows, layouts flip',
            'body' => 'Dynamic Type and Android font scaling reach every control, and labels wrap instead of truncating. Right-to-left layouts mirror natively, with code kept left-to-right.',
        ],
        [
            'title' => 'Motion and time follow the reader',
            'body' => 'Reduce Motion is honoured by the platform controls, and feedback fades instead of sliding on iOS. Feedback stays longer while a screen reader is on.',
        ],
        [
            'title' => 'Targets you can hit',
            'body' => 'Every action Firstlight owns, from icon buttons to the search clear button, is at least 44 points on iOS and 48 dp on Android.',
        ],
        [
            'title' => 'Status is not colour alone',
            'body' => 'Callouts name their tone in words, and status colours below 4.5:1 contrast are corrected to black or white text as they render.',
        ],
    ];
@endphp

<x-layouts.app
    title="Firstlight UI — The app-shell layer for NativePHP"
    description="Build a standard NativePHP forms app, by hand or with a coding agent: genuine SwiftUI and Jetpack Compose controls, Laravel validation, accessible by default, with tested recipes and a Laravel Boost guideline."
    :schema="$structuredData->home()"
>
    <section class="relative py-16 sm:py-24 lg:py-28">
        <div class="pointer-events-none absolute inset-0 technical-grid" aria-hidden="true"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-6 lg:grid-cols-[13fr_11fr] lg:px-8">
            <div class="hero-reveal flex min-w-0 flex-col items-start gap-8">
                <div class="flex flex-col items-start gap-5">
                    <p class="{{ $eyebrow }}">
                        For <a href="https://nativephp.com" class="rounded-sm underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)" target="_blank" rel="noreferrer">NativePHP</a> and Laravel Boost
                    </p>
                    <h1 class="max-w-[14ch] text-5xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-7xl lg:text-[5.25rem]">
                        The <span class="whitespace-nowrap">app-shell</span> layer for NativePHP.
                    </h1>
                    <p class="max-w-[50ch] text-xl text-pretty text-(--site-muted)">
                        <code class="{{ $code }} text-(--site-heading)">composer require firstlightui/nativephp</code> and Laravel Boost give you, or your coding agent, what a standard forms app needs: lists and detail, search, forms with Laravel validation, settings, sheets and dialogs, and feedback.
                    </p>
                    <p class="max-w-[50ch] text-lg text-pretty text-(--site-muted)">
                        Every control is genuine SwiftUI on iOS and Jetpack Compose on Android. It runs on the SuperNative foundation created by <a href="https://github.com/shanerbaner82" class="{{ $inlineLink }}" target="_blank" rel="noreferrer">Shane Rosenthal</a> and <a href="https://github.com/simonhamp" class="{{ $inlineLink }}" target="_blank" rel="noreferrer">Simon Hamp</a>.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-x-5 gap-y-3">
                    <a
                        href="#recipes"
                        class="rounded-full bg-(--site-primary) px-4 py-3 text-base font-semibold text-(--site-on-primary) ring-1 ring-(--site-primary) hover:bg-(--site-primary-hover) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus) active:translate-y-px sm:text-sm"
                    >
                        Start with a recipe
                    </a>
                    <a href="#agents" class="{{ $textLink }}">
                        Set up your coding agent →
                    </a>
                </div>

                <dl class="grid w-full grid-cols-2 gap-x-6 gap-y-4 border-t border-(--site-border) pt-6 sm:grid-cols-4">
                    <div class="flex flex-col gap-1">
                        <dt class="text-base text-(--site-muted) sm:text-sm">iOS</dt>
                        <dd class="font-medium text-(--site-heading)">SwiftUI</dd>
                    </div>
                    <div class="flex flex-col gap-1">
                        <dt class="text-base text-(--site-muted) sm:text-sm">Android</dt>
                        <dd class="font-medium text-(--site-heading)">Compose M3</dd>
                    </div>
                    <div class="flex flex-col gap-1">
                        <dt class="text-base text-(--site-muted) sm:text-sm">For agents</dt>
                        <dd class="font-medium text-(--site-heading)">Boost + llms.txt</dd>
                    </div>
                    <div class="flex flex-col gap-1">
                        <dt class="text-base text-(--site-muted) sm:text-sm">Status</dt>
                        <dd class="font-medium text-(--site-heading)">1.0.0-RC6</dd>
                    </div>
                </dl>
            </div>

            <div class="hero-reveal-late relative min-h-[36rem] overflow-hidden rounded-[min(4vw,var(--radius-panel))] p-4 ring-1 ring-(--site-border) dawn-field sm:p-6 lg:min-h-[42rem]" role="img" aria-label="A Firstlight form field in Blade, shown with its validation error on iOS and Android">
                <div class="absolute inset-0 technical-grid opacity-45" aria-hidden="true"></div>

                <div class="relative rounded-[calc(var(--radius-panel)-0.5rem)] bg-(--site-code) p-5 shadow-2xl ring-1 ring-(--site-border) dark:shadow-none sm:p-6" aria-hidden="true">
                    <div class="flex items-center justify-between gap-4 border-b border-white/10 pb-4">
                        <p class="font-mono text-base text-(--site-code-muted) sm:text-sm">create-post.blade.php</p>
                        <p class="font-mono text-base text-(--site-code-muted) sm:text-sm">EDGE</p>
                    </div>
                    <pre class="overflow-x-auto pt-5 font-mono text-base text-(--site-code-text) sm:text-sm"><code><span class="text-(--site-code-keyword)">&lt;firstlight:text-field</span>
    label=<span class="text-(--site-code-string)">"Title"</span>
    native:model=<span class="text-(--site-code-string)">"title"</span>
    required
<span class="text-(--site-code-keyword)">/&gt;</span>

<span class="text-(--site-code-muted)">// CreatePostScreen.php</span>
<span class="text-(--site-code-keyword)">$this</span>->validate(
    StorePostRequest::<span class="text-(--site-code-keyword)">class</span>,
);</code></pre>
                </div>

                <div class="absolute right-4 bottom-5 left-4 grid grid-cols-2 gap-3 sm:right-6 sm:bottom-6 sm:left-6 sm:gap-5" aria-hidden="true">
                    <div class="-rotate-2 rounded-[min(4vw,2rem)] bg-[oklch(0.98_0.006_255)] p-4 text-[oklch(0.22_0.03_255)] shadow-2xl ring-1 ring-black/10 dark:shadow-none sm:p-5">
                        <div class="flex items-center justify-between gap-3 border-b border-black/8 pb-3">
                            <p class="font-medium">iOS</p>
                            <p class="font-mono text-sm text-[oklch(0.46_0.025_255)]">SwiftUI</p>
                        </div>
                        <div class="flex flex-col gap-2 pt-5">
                            <p class="font-semibold">Title *</p>
                            <div class="rounded-xl bg-[oklch(0.93_0.008_255)] px-3 py-2.5">Hi</div>
                            <p class="text-sm leading-snug text-[oklch(0.52_0.2_27)]">The title field must be at least 3 characters.</p>
                        </div>
                    </div>

                    <div class="rotate-2 translate-y-6 rounded-[min(4vw,2rem)] bg-[oklch(0.97_0.008_85)] p-4 text-[oklch(0.21_0.03_58)] shadow-2xl ring-1 ring-black/10 dark:shadow-none sm:p-5">
                        <div class="flex items-center justify-between gap-3 border-b border-black/8 pb-3">
                            <p class="font-medium">Android</p>
                            <p class="font-mono text-sm text-[oklch(0.45_0.03_58)]">Compose</p>
                        </div>
                        <div class="flex flex-col gap-1.5 pt-5">
                            <div class="relative rounded-md px-3 pt-3 pb-2.5 ring-2 ring-[oklch(0.5_0.19_27)]">
                                <span class="absolute -top-2.5 left-2 bg-[oklch(0.97_0.008_85)] px-1 text-xs font-medium text-[oklch(0.5_0.19_27)]">Title *</span>
                                Hi
                            </div>
                            <p class="px-3 text-sm leading-snug text-[oklch(0.5_0.19_27)]">The title field must be at least 3 characters.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="recipes" class="border-y border-(--site-border) bg-(--site-surface) py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid items-end gap-8 lg:grid-cols-[13fr_11fr] lg:gap-12">
                <div class="flex flex-col gap-5">
                    <p class="{{ $eyebrow }}">Start with a recipe</p>
                    <h2 class="{{ $sectionHeading }}">
                        Four screens cover most forms apps.
                    </h2>
                </div>
                <p class="{{ $lead }}">
                    Each recipe is a complete screen you can copy, or hand to your coding agent. Each one runs unchanged in the <a href="https://github.com/firstlightui/showcase" class="{{ $inlineLink }}" target="_blank" rel="noreferrer">showcase app</a>, whose Pest tests exercise it.
                </p>
            </div>

            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($recipes as $recipe)
                    <a href="{{ route('docs.show', ['path' => $recipe['path']]) }}" class="{{ str_replace('bg-(--site-surface)', 'bg-(--site-canvas)', $card) }}">
                        <p class="{{ $cardEyebrow }}">Recipe {{ $recipe['step'] }}</p>
                        <p class="text-xl font-semibold text-(--site-heading)">{{ $recipe['title'] }}</p>
                        <p class="text-base text-pretty text-(--site-muted) sm:text-sm">{{ $recipe['summary'] }}</p>
                        <span class="{{ $cardLink }} mt-auto">Read the recipe →</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section id="agents" class="py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl items-start gap-12 px-6 lg:grid-cols-[13fr_11fr] lg:px-8">
            <div class="flex flex-col gap-6">
                <p class="{{ $eyebrow }}">Built for coding agents</p>
                <h2 class="{{ $sectionHeading }}">
                    Your agent already knows the recipes.
                </h2>
                <p class="{{ $lead }}">
                    Firstlight ships a Laravel Boost guideline and two skills. Install Boost and your agent learns the rules every Firstlight screen follows, which recipe fits the screen you ask for, and which control fits each value.
                </p>

                <dl class="flex flex-col divide-y divide-(--site-border) border-y border-(--site-border)">
                    <div class="flex flex-col gap-1 py-5">
                        <dt class="font-semibold text-(--site-heading)">Boost guideline</dt>
                        <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">Always in your agent’s instructions: native chrome, Laravel validation, confirmed deletion, theme colours, and a tested example.</dd>
                    </div>
                    <div class="flex flex-col gap-1 py-5">
                        <dt class="font-mono font-semibold text-(--site-heading)">firstlight-init</dt>
                        <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">Interviews you, checks the install, sets the theme and the native-chrome layout, and scaffolds your chosen recipes with tests.</dd>
                    </div>
                    <div class="flex flex-col gap-1 py-5">
                        <dt class="font-mono font-semibold text-(--site-heading)">building-firstlight-screens</dt>
                        <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">Picks the recipe and the controls for each new screen, and lists what never to do.</dd>
                    </div>
                    <div class="flex flex-col gap-1 py-5">
                        <dt class="font-semibold text-(--site-heading)"><a href="{{ route('llms') }}" class="{{ $inlineLink }} font-mono">llms.txt</a> and <a href="{{ route('llms.full') }}" class="{{ $inlineLink }} font-mono">llms-full.txt</a></dt>
                        <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">Every documentation page in one request, recipes first. The package ships <code class="{{ $code }}">llms-full.txt</code> too, matching the installed version.</dd>
                    </div>
                </dl>

                <a href="{{ route('docs.show', ['path' => 'getting-started/build-with-a-coding-agent']) }}" class="{{ $textLink }} self-start">Build with a coding agent →</a>
            </div>

            <div class="flex min-w-0 flex-col gap-5">
                <div class="min-w-0 rounded-(--radius-panel) bg-(--site-code) p-5 ring-1 ring-(--site-border) sm:p-6">
                    <p class="border-b border-white/10 pb-4 font-mono text-base text-(--site-code-muted) sm:text-sm">Terminal</p>
                    <pre class="overflow-x-auto pt-5 font-mono text-base text-(--site-code-text) sm:text-sm"><code><span class="text-(--site-code-muted)">$</span> composer require <span class="text-(--site-code-string)">"firstlightui/nativephp:^1.0@RC"</span>
<span class="text-(--site-code-muted)">$</span> composer require laravel/boost --dev
<span class="text-(--site-code-muted)">$</span> php artisan boost:install</code></pre>
                </div>

                <figure class="flex flex-col gap-3 rounded-(--radius-panel) bg-(--site-surface) p-6 ring-1 ring-(--site-border)">
                    <figcaption class="{{ $cardEyebrow }}">Then ask for the app</figcaption>
                    <blockquote class="text-lg text-pretty text-(--site-heading)">
                        “Set up this app with Firstlight. The main record is a job. I want a searchable list of jobs, a form to create one, and a settings screen.”
                    </blockquote>
                </figure>

                <p class="text-base text-pretty text-(--site-muted) sm:text-sm">
                    An agent writes the screens and runs their Pest tests. Both skills end by asking you to check the app on an iOS simulator and an Android emulator.
                </p>
            </div>
        </div>
    </section>

    <section id="native" class="border-y border-(--site-border) bg-(--site-surface) py-20 sm:py-24">
        <span id="why-firstlight"></span>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex flex-col gap-5">
                <p class="{{ $eyebrow }}">Genuine native controls</p>
                <h2 class="{{ $sectionHeading }}">
                    One API, the right pattern on each platform.
                </h2>
                <p class="{{ $lead }}">
                    Every Firstlight control is a real SwiftUI control on iOS and a Jetpack Compose Material 3 control on Android. Nothing is drawn to imitate a platform control, and there is no WebView. You write one Blade tag; each platform shows its own pattern.
                </p>
            </div>

            <dl class="mt-12 divide-y divide-(--site-border) overflow-hidden rounded-(--radius-panel) bg-(--site-canvas) ring-1 ring-(--site-border) sm:hidden">
                @foreach ($platformPatterns as [$control, $ios, $android])
                    <div class="flex flex-col gap-1 px-4 py-4 text-base">
                        <dt class="font-medium text-(--site-heading)">{{ $control }}</dt>
                        <dd class="text-(--site-muted)"><span class="text-(--site-heading)">iOS:</span> {{ $ios }}</dd>
                        <dd class="text-(--site-muted)"><span class="text-(--site-heading)">Android:</span> {{ $android }}</dd>
                    </div>
                @endforeach
            </dl>

            <div class="mt-12 hidden overflow-hidden rounded-(--radius-panel) ring-1 ring-(--site-border) sm:block">
                <table class="w-full text-left text-sm">
                    <caption class="sr-only">How one Firstlight API appears on iOS and Android</caption>
                    <thead class="bg-(--site-recessed) text-(--site-heading)">
                        <tr>
                            <th scope="col" class="px-3 py-3 font-semibold sm:px-5">You write</th>
                            <th scope="col" class="px-3 py-3 font-semibold sm:px-5">iOS shows</th>
                            <th scope="col" class="px-3 py-3 font-semibold sm:px-5">Android shows</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-(--site-border) bg-(--site-canvas) text-(--site-muted)">
                        @foreach ($platformPatterns as [$control, $ios, $android])
                            <tr>
                                <th scope="row" class="px-3 py-3 align-top font-medium text-(--site-heading) sm:px-5">{{ $control }}</th>
                                <td class="px-3 py-3 align-top sm:px-5">{{ $ios }}</td>
                                <td class="px-3 py-3 align-top sm:px-5">{{ $android }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-16 flex flex-col gap-5">
                <h3 class="text-2xl font-semibold tracking-tight text-(--site-heading)">What Firstlight is not</h3>
                <dl class="grid gap-0 md:grid-cols-3">
                    <div class="flex flex-col gap-3 border-t border-(--site-border) py-6 md:border-r md:pr-8">
                        <dt class="text-lg font-semibold text-(--site-heading)">Not navigation chrome</dt>
                        <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                            Stacks, title bars, back navigation, and tab bars come from NativePHP’s native chrome, <code class="{{ $code }}">usesNativeChrome()</code>. Firstlight works inside it and does not replace it.
                        </dd>
                    </div>
                    <div class="flex flex-col gap-3 border-t border-(--site-border) py-6 md:border-r md:px-8">
                        <dt class="text-lg font-semibold text-(--site-heading)">Not a design system</dt>
                        <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                            Controls take colours and fonts from the NativePHP theme and keep each platform’s own geometry, motion, and materials.
                        </dd>
                    </div>
                    <div class="flex flex-col gap-3 border-t border-(--site-border) py-6 md:pl-8">
                        <dt class="text-lg font-semibold text-(--site-heading)">Not a catalogue of everything</dt>
                        <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                            No charts, no carousels, nothing custom-drawn. A control is added only when it has an equal native contract on iOS and Android.
                        </dd>
                    </div>
                </dl>
                <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                    <a href="{{ route('docs.show', ['path' => 'concepts/firstlight-and-mobile-ui']) }}" class="{{ $textLink }}">What Firstlight is →</a>
                    <a href="{{ route('comparison') }}" class="rounded-sm py-2 text-base font-normal text-(--site-muted) underline decoration-(--site-border-strong) underline-offset-4 hover:text-(--site-heading) hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus) sm:text-sm">Firstlight vs NativePHP Mobile UI</a>
                </div>
            </div>
        </div>
    </section>

    <section id="laravel" class="py-20 sm:py-24">
        <span id="extensions"></span>
        <span id="validation"></span>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex flex-col gap-5">
                <p class="{{ $eyebrow }}">Feels like Laravel</p>
                <h2 class="{{ $sectionHeading }}">
                    Form Requests, Gates, and Pest on native screens.
                </h2>
                <p class="{{ $lead }}">
                    NativePHP EDGE has no screen-level <code class="{{ $code }}">validate()</code>. Without it, errors appear as sibling <code class="{{ $code }}">@@nativeError</code> text or the generic error overlay. Firstlight adds <code class="{{ $code }}">ValidatesFields</code>, <code class="{{ $code }}">SubmitsForms</code>, <code class="{{ $code }}">AuthorizesActions</code>, and list pagination and deletion as concerns on <code class="{{ $code }}">NativeComponent</code>, so each message lands in the field’s native error slot.
                </p>
            </div>

            <dl class="mt-16 grid gap-0 lg:grid-cols-3">
                <div class="flex flex-col gap-4 border-t border-(--site-border) py-8 lg:border-t-0 lg:border-r lg:py-0 lg:pr-8">
                    <dt class="text-xl font-semibold text-(--site-heading)">Validate with a Form Request</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        Use <code class="{{ $code }}">$rules</code> or a Form Request. Each field shows its first message natively, and <code class="{{ $code }}">&lt;firstlight:callout error-for="form" /&gt;</code> shows errors that belong to the whole form.
                    </dd>
                    <dd class="rounded-[calc(var(--radius-panel)-0.5rem)] bg-(--site-code) p-5 ring-1 ring-(--site-border)">
                        <pre class="overflow-x-auto font-mono text-base text-(--site-code-text) sm:text-sm"><code><span class="text-(--site-code-keyword)">$this</span>->validate(
    StorePostRequest::<span class="text-(--site-code-keyword)">class</span>,
);</code></pre>
                    </dd>
                </div>
                <div class="flex flex-col gap-4 border-t border-(--site-border) py-8 lg:border-t-0 lg:border-r lg:px-8 lg:py-0">
                    <dt class="text-xl font-semibold text-(--site-heading)">Submit once, authorize with Gates</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        <code class="{{ $code }}">submit()</code> validates, runs the action once, and sends success Feedback. <code class="{{ $code }}">authorize()</code> hides, disables, or guards actions with your Policies instead of the error overlay.
                    </dd>
                    <dd class="rounded-[calc(var(--radius-panel)-0.5rem)] bg-(--site-code) p-5 ring-1 ring-(--site-border)">
                        <pre class="overflow-x-auto font-mono text-base text-(--site-code-text) sm:text-sm"><code><span class="text-(--site-code-keyword)">$this</span>->submit(
    action: fn () => $post->save(),
    successMessage: <span class="text-(--site-code-string)">'Saved'</span>,
);</code></pre>
                    </dd>
                </div>
                <div class="flex flex-col gap-4 border-y border-(--site-border) py-8 lg:border-y-0 lg:py-0 lg:pl-8">
                    <dt class="text-xl font-semibold text-(--site-heading)">Test with Pest</dt>
                    <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">
                        <code class="{{ $code }}">ScreenAssertions</code> adds field-error, list, dialog, and Feedback checks to NativePHP’s <code class="{{ $code }}">Native::test()</code>. <code class="{{ $code }}">make:firstlight-screen --test</code> scaffolds a screen and its test.
                    </dd>
                    <dd class="rounded-[calc(var(--radius-panel)-0.5rem)] bg-(--site-code) p-5 ring-1 ring-(--site-border)">
                        <pre class="overflow-x-auto font-mono text-base text-(--site-code-text) sm:text-sm"><code>Native::visit(<span class="text-(--site-code-string)">'/posts/create'</span>)
    ->set(<span class="text-(--site-code-string)">'title'</span>, <span class="text-(--site-code-string)">'Hi'</span>)
    ->call(<span class="text-(--site-code-string)">'save'</span>)
    ->assertFieldError(<span class="text-(--site-code-string)">'title'</span>);</code></pre>
                    </dd>
                </div>
            </dl>

            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('docs.show', ['path' => 'how-to/validate-fields']) }}" class="{{ $card }}">
                    <p class="{{ $cardEyebrow }}">How-to</p>
                    <p class="text-xl font-semibold text-(--site-heading)">Validate fields</p>
                    <p class="text-base text-pretty text-(--site-muted) sm:text-sm">validate(), validateOnly(), and Form Requests, with messages on native fields.</p>
                    <span class="{{ $cardLink }} mt-auto">Read the guide →</span>
                </a>
                <a href="{{ route('docs.show', ['path' => 'how-to/submit-forms']) }}" class="{{ $card }}">
                    <p class="{{ $cardEyebrow }}">How-to</p>
                    <p class="text-xl font-semibold text-(--site-heading)">Submit forms</p>
                    <p class="text-base text-pretty text-(--site-muted) sm:text-sm">Validate, run a PHP action once, and publish success Feedback.</p>
                    <span class="{{ $cardLink }} mt-auto">Read the guide →</span>
                </a>
                <a href="{{ route('docs.show', ['path' => 'how-to/authorize-actions']) }}" class="{{ $card }}">
                    <p class="{{ $cardEyebrow }}">How-to</p>
                    <p class="text-xl font-semibold text-(--site-heading)">Authorize actions</p>
                    <p class="text-base text-pretty text-(--site-muted) sm:text-sm">Hide, disable, or guard actions with Laravel Gates and Policies.</p>
                    <span class="{{ $cardLink }} mt-auto">Read the guide →</span>
                </a>
                <a href="{{ route('docs.show', ['path' => 'how-to/test-screens']) }}" class="{{ $card }}">
                    <p class="{{ $cardEyebrow }}">How-to</p>
                    <p class="text-xl font-semibold text-(--site-heading)">Test screens</p>
                    <p class="text-base text-pretty text-(--site-muted) sm:text-sm">Scaffold with make:firstlight-screen and test with Native::test().</p>
                    <span class="{{ $cardLink }} mt-auto">Read the guide →</span>
                </a>
            </div>
        </div>
    </section>

    <section id="accessibility" class="border-y border-(--site-border) bg-(--site-surface) py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid items-end gap-8 lg:grid-cols-[13fr_11fr] lg:gap-12">
                <div class="flex flex-col gap-5">
                    <p class="{{ $eyebrow }}">Accessible by default</p>
                    <h2 class="{{ $sectionHeading }}">
                        Real native controls, so assistive technology just works.
                    </h2>
                </div>
                <p class="{{ $lead }}">
                    Firstlight never draws its own controls. VoiceOver, TalkBack, Dynamic Type, font scaling, dark mode, Increased Contrast, Reduce Motion, and right-to-left layout reach every control the way they reach the platform’s own apps. Firstlight adds the decisions a native control can’t make on its own.
                </p>
            </div>

            <dl class="mt-14 grid gap-x-8 gap-y-0 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($accessibility as $feature)
                    <div class="flex flex-col gap-3 border-t border-(--site-border) py-8">
                        <dt class="text-xl font-semibold text-(--site-heading)">{{ $feature['title'] }}</dt>
                        <dd class="text-base text-pretty text-(--site-muted) sm:text-sm">{{ $feature['body'] }}</dd>
                    </div>
                @endforeach
            </dl>

            <div class="mt-6 flex flex-col gap-4 rounded-(--radius-panel) bg-(--site-canvas) p-6 ring-1 ring-(--site-border) sm:p-8 lg:flex-row lg:items-center lg:justify-between lg:gap-12">
                <div class="flex flex-col gap-2">
                    <p class="{{ $cardEyebrow }}">Where verification stands</p>
                    <p class="max-w-[70ch] text-base text-pretty text-(--site-muted) sm:text-sm">
                        This behaviour is covered by contract, XCTest, and Robolectric tests, and TalkBack moving to the first invalid field was observed on the Android emulator. Spoken VoiceOver and TalkBack output has not yet been checked on physical devices; that is part of the remaining 1.0.0 qualification.
                    </p>
                </div>
                <a href="{{ route('docs.show', ['path' => 'concepts/accessibility']) }}" class="{{ $textLink }} shrink-0">What’s covered and what’s tested →</a>
            </div>
        </div>
    </section>

    <section id="components" class="py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid items-end gap-8 lg:grid-cols-[13fr_11fr] lg:gap-12">
                <div class="flex flex-col gap-5">
                    <p class="{{ $eyebrow }}">Components</p>
                    <h2 class="{{ $sectionHeading }}">
                        Every control, on both platforms.
                    </h2>
                </div>
                <p class="{{ $lead }}">
                    Fields, choices, lists, dialogs, sheets, status, and feedback. Every field shares the same value, label, error, disabled, and required behaviour, so a form needs no per-control special cases. Each screenshot below comes from the iOS and Android renderers.
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
                <p class="font-mono text-base uppercase tracking-wide text-(--site-code-keyword) sm:text-sm">How it renders</p>
                <h2 class="max-w-[18ch] text-4xl font-semibold tracking-tight text-balance sm:text-5xl">
                    The same rendering pipeline as NativePHP.
                </h2>
                <p class="max-w-[56ch] text-lg text-pretty text-(--site-code-muted)">
                    Firstlight uses the same EDGE element tree, renderers, theme, and event lifecycle as NativePHP Mobile UI. Ordinary interaction, such as typing and scrolling, stays on the native UI thread.
                </p>
            </div>

            <dl class="divide-y divide-white/10 border-y border-white/10">
                <div class="grid grid-cols-[auto_1fr] gap-x-5 py-5">
                    <dt class="font-mono text-base text-(--site-code-keyword) sm:text-sm">01</dt>
                    <dd class="text-base text-pretty text-(--site-code-text) sm:text-sm">Your Blade view compiles to Firstlight elements.</dd>
                </div>
                <div class="grid grid-cols-[auto_1fr] gap-x-5 py-5">
                    <dt class="font-mono text-base text-(--site-code-keyword) sm:text-sm">02</dt>
                    <dd class="text-base text-pretty text-(--site-code-text) sm:text-sm">The shared element tree describes each control in platform-neutral terms.</dd>
                </div>
                <div class="grid grid-cols-[auto_1fr] gap-x-5 py-5">
                    <dt class="font-mono text-base text-(--site-code-keyword) sm:text-sm">03</dt>
                    <dd class="text-base text-pretty text-(--site-code-text) sm:text-sm">SwiftUI on iOS and Jetpack Compose on Android draw the native control.</dd>
                </div>
            </dl>
        </div>
    </section>

    <section id="quickstart" class="py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="rounded-[min(3vw,var(--radius-panel))] bg-(--site-surface) p-6 ring-1 ring-(--site-border) sm:p-10 lg:p-12">
                <div class="grid min-w-0 grid-cols-1 items-end gap-12 lg:grid-cols-[13fr_11fr]">
                    <div class="flex min-w-0 flex-col gap-6">
                        <p class="{{ $eyebrow }}">Quickstart</p>
                        <h2 class="max-w-[18ch] text-4xl font-semibold tracking-tight text-balance text-(--site-heading) sm:text-5xl">
                            Add Firstlight to a NativePHP app.
                        </h2>
                        <p class="max-w-[56ch] text-lg text-pretty text-(--site-muted)">
                            Requires NativePHP Mobile <code class="{{ $code }}">^4.6</code> and Mobile UI <code class="{{ $code }}">^0.8</code>.
                        </p>
                        <p class="max-w-[56ch] text-base text-pretty text-(--site-muted)">
                            Build your screens with <code class="{{ $code }}">FirstlightUI\NativeComponent</code>, starting from the <a href="{{ route('docs.show', ['path' => 'how-to/build-a-list-detail-flow']) }}" class="{{ $inlineLink }}">list and detail recipe</a>. Add Laravel Boost so your coding agent does the same.
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
                        <a href="{{ route('docs.show', ['path' => 'getting-started/installation']) }}" class="{{ $textLink }} self-start">
                            Read the installation guide →
                        </a>
                        <p class="text-base text-pretty text-(--site-muted) sm:text-sm">
                            Firstlight 1.0.0 is a release candidate. Use it for evaluation, not production. Testing on real phones, spoken screen-reader checks, long-running performance tests, and use in more apps are still pending. Read the
                            <a href="{{ route('docs.show', ['path' => 'reference/compatibility']) }}" class="rounded-sm underline decoration-(--site-border-strong) underline-offset-4 hover:decoration-(--site-primary) focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--site-focus)">compatibility notes</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
