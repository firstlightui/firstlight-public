@props([
    'navigation',
    'currentSlug',
])

<nav {{ $attributes->merge(['class' => 'flex flex-col gap-8']) }} aria-label="Documentation navigation">
    <div class="flex flex-col gap-2">
        <p class="px-3 font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-muted)">Documentation</p>

        @if ($navigation['overview'] !== null)
            <a
                href="{{ route('docs.show') }}"
                @class([
                    'group flex min-h-11 items-center justify-between gap-3 rounded-xl px-3 py-2.5 text-sm font-medium focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)',
                    'bg-(--site-recessed) text-(--site-heading)' => $currentSlug === 'index',
                    'text-(--site-muted) hover:bg-(--site-recessed) hover:text-(--site-heading)' => $currentSlug !== 'index',
                ])
                @if ($currentSlug === 'index') aria-current="page" @endif
            >
                <span>Overview</span>
                @if ($currentSlug === 'index')
                    <span class="size-1.5 shrink-0 rounded-full bg-(--site-primary)" aria-hidden="true"></span>
                @endif
            </a>
        @endif
    </div>

    @foreach ($navigation['sections'] as $section)
        <div class="flex flex-col gap-2">
            <p class="px-3 font-mono text-xs font-medium uppercase tracking-[0.12em] text-(--site-muted)">{{ $section['title'] }}</p>

            <div class="flex flex-col gap-1">
                @foreach ($section['documents'] as $document)
                    <a
                        href="{{ route('docs.show', ['path' => $document['slug']]) }}"
                        @class([
                            'group flex min-h-11 items-center justify-between gap-3 rounded-xl px-3 py-2.5 text-sm font-medium focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--site-focus)',
                            'bg-(--site-recessed) text-(--site-heading)' => $currentSlug === $document['slug'],
                            'text-(--site-muted) hover:bg-(--site-recessed) hover:text-(--site-heading)' => $currentSlug !== $document['slug'],
                        ])
                        @if ($currentSlug === $document['slug']) aria-current="page" @endif
                    >
                        <span>{{ $document['title'] }}</span>
                        @if ($currentSlug === $document['slug'])
                            <span class="size-1.5 shrink-0 rounded-full bg-(--site-primary)" aria-hidden="true"></span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach
</nav>
