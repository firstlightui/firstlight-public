@props(['slug', 'platform'])

<div
    class="@container flex h-full w-full max-w-72 items-center justify-center"
    role="img"
    aria-label="Illustrated {{ $platform === 'ios' ? 'iOS' : 'Android' }} {{ str($slug)->headline() }} state"
    data-component-mock="{{ $slug }}"
    data-platform="{{ $platform }}"
>
    @if ($slug === 'checkbox')
        <div
            @class([
                'w-full bg-[oklch(0.975_0.008_70)] p-3 text-[oklch(0.2_0.025_48)] @min-[220px]:p-5 dark:bg-[oklch(0.16_0.018_44)] dark:text-[oklch(0.95_0.012_68)]',
                'rounded-2xl' => $platform === 'ios',
                'rounded-lg' => $platform === 'android',
            ])
            aria-hidden="true"
        >
            <div class="flex items-start gap-2 @min-[220px]:gap-3">
                <span
                    @class([
                        'mt-0.5 grid size-5 shrink-0 place-items-center bg-[oklch(0.55_0.2_28)] text-xs font-bold text-[oklch(0.98_0.01_70)] @min-[220px]:size-6 @min-[220px]:text-sm',
                        'rounded-md' => $platform === 'ios',
                        'rounded-xs' => $platform === 'android',
                    ])
                >✓</span>
                <span class="flex min-w-0 flex-col gap-1">
                    <span class="text-sm leading-tight font-semibold @min-[220px]:text-base">I agree to the terms</span>
                    <span class="text-xs leading-tight text-[oklch(0.48_0.025_48)] @min-[220px]:text-sm @min-[220px]:leading-snug dark:text-[oklch(0.72_0.02_65)]">Required before continuing.</span>
                </span>
            </div>
        </div>
    @else
        @if ($platform === 'ios')
            <div class="w-full space-y-1 text-center text-[oklch(0.2_0.025_48)] @min-[220px]:space-y-2" aria-hidden="true">
                <div class="overflow-hidden rounded-xl bg-[oklch(0.975_0.008_70)] @min-[220px]:rounded-2xl dark:bg-[oklch(0.2_0.018_44)] dark:text-[oklch(0.95_0.012_68)]">
                    <div class="space-y-0.5 px-3 py-2 @min-[220px]:space-y-1 @min-[220px]:px-5 @min-[220px]:py-4">
                        <p class="text-sm leading-tight font-semibold @min-[220px]:text-base">Delete appointment?</p>
                        <p class="text-[0.6875rem] leading-tight text-[oklch(0.48_0.025_48)] @min-[220px]:text-sm dark:text-[oklch(0.72_0.02_65)]">This action cannot be undone.</p>
                    </div>
                    <div class="border-t border-(--site-border) px-3 py-2 text-sm font-semibold text-[oklch(0.55_0.2_28)] @min-[220px]:px-5 @min-[220px]:py-3 @min-[220px]:text-base">Delete</div>
                </div>
                <div class="rounded-xl bg-[oklch(0.975_0.008_70)] px-3 py-2 text-sm font-semibold @min-[220px]:rounded-2xl @min-[220px]:px-5 @min-[220px]:py-3 @min-[220px]:text-base dark:bg-[oklch(0.2_0.018_44)] dark:text-[oklch(0.95_0.012_68)]">Keep appointment</div>
            </div>
        @else
            <div class="w-full rounded-lg bg-[oklch(0.975_0.008_70)] p-3 text-[oklch(0.2_0.025_48)] shadow-lg shadow-[oklch(0.2_0.025_48/0.12)] @min-[220px]:rounded-xl @min-[220px]:p-6 dark:bg-[oklch(0.2_0.018_44)] dark:text-[oklch(0.95_0.012_68)]" aria-hidden="true">
                <div class="space-y-1 @min-[220px]:space-y-2">
                    <p class="text-sm leading-tight font-semibold @min-[220px]:text-lg">Delete appointment?</p>
                    <p class="text-[0.6875rem] leading-tight text-[oklch(0.48_0.025_48)] @min-[220px]:text-sm @min-[220px]:leading-relaxed dark:text-[oklch(0.72_0.02_65)]">This action cannot be undone.</p>
                </div>
                <div class="mt-3 flex justify-end gap-2 text-[0.625rem] font-semibold uppercase @min-[220px]:mt-6 @min-[220px]:gap-5 @min-[220px]:text-sm @min-[220px]:tracking-wide">
                    <span>Cancel</span>
                    <span class="text-[oklch(0.55_0.2_28)]">Delete</span>
                </div>
            </div>
        @endif
    @endif
</div>
