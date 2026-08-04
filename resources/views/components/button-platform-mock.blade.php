@props(['platform'])

<div
    class="flex h-full w-full max-w-72 flex-col justify-center gap-4 bg-[oklch(0.975_0.008_70)] p-5 text-[oklch(0.2_0.025_48)] dark:bg-[oklch(0.16_0.018_44)] dark:text-[oklch(0.95_0.012_68)] sm:p-6"
    role="img"
    aria-label="Illustrated {{ $platform === 'ios' ? 'iOS' : 'Android' }} Button states"
    data-component-mock="button"
>
    <p class="text-sm font-semibold">Actions</p>

    @if ($platform === 'ios')
        <div class="grid gap-3">
            <span class="rounded-xl bg-[oklch(0.55_0.2_28)] px-4 py-3 text-center font-semibold text-[oklch(0.98_0.01_70)]">Continue</span>
            <span class="rounded-xl bg-[oklch(0.92_0.015_65)] px-4 py-3 text-center font-semibold text-[oklch(0.32_0.04_45)] dark:bg-[oklch(0.26_0.025_45)] dark:text-[oklch(0.94_0.012_68)]">Add note</span>
            <span class="rounded-xl px-4 py-3 text-center font-semibold text-(--site-muted) ring-1 ring-inset ring-(--site-border-strong)">Saving…</span>
        </div>
    @else
        <div class="grid gap-3">
            <span class="rounded-full bg-[oklch(0.55_0.2_28)] px-5 py-3 text-center font-semibold text-[oklch(0.98_0.01_70)]">Continue</span>
            <span class="rounded-full bg-[oklch(0.9_0.035_55)] px-5 py-3 text-center font-semibold text-[oklch(0.34_0.055_42)] dark:bg-[oklch(0.29_0.04_42)] dark:text-[oklch(0.94_0.02_65)]">Add note</span>
            <span class="rounded-full px-5 py-3 text-center font-semibold text-(--site-muted) ring-1 ring-inset ring-(--site-border-strong)">Saving…</span>
        </div>
    @endif
</div>
