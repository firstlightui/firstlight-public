<?php

namespace App;

use Illuminate\Support\Arr;

/**
 * JSON-LD documents describing Firstlight to search engines, answer engines, and agents.
 *
 * Everything here must stay literally true. Firstlight is alpha and has no users, so there
 * is deliberately no aggregateRating, review, or install count: fabricated trust signals are
 * both a spam-policy risk and worse than saying nothing.
 */
class StructuredData
{
    private const PACKAGE_REPOSITORY = 'https://github.com/firstlightui/nativephp';

    /**
     * @return array<string, mixed>
     */
    public function home(): array
    {
        return $this->graph([
            $this->organization(),
            [
                '@type' => 'SoftwareApplication',
                '@id' => route('home').'#software',
                'name' => 'Firstlight UI',
                'alternateName' => 'firstlightui/nativephp',
                'applicationCategory' => 'DeveloperApplication',
                'applicationSubCategory' => 'Mobile UI component library',
                'operatingSystem' => 'iOS, Android',
                'url' => route('home'),
                'downloadUrl' => 'https://packagist.org/packages/firstlightui/nativephp',
                'codeRepository' => self::PACKAGE_REPOSITORY,
                'license' => 'https://opensource.org/licenses/MIT',
                'isAccessibleForFree' => true,
                'programmingLanguage' => ['PHP', 'Swift', 'Kotlin'],
                'softwareRequirements' => 'PHP, Laravel, NativePHP Mobile, NativePHP Mobile UI',
                'description' => 'The app-shell layer for NativePHP. Firstlight gives a standard forms app its lists, search, forms, settings, sheets, dialogs, and feedback as genuine SwiftUI controls on iOS and Jetpack Compose controls on Android, with Laravel validation, Gate-backed authorization, tested recipes, and a Laravel Boost guideline for coding agents.',
                'offers' => [
                    '@type' => 'Offer',
                    'price' => '0',
                    'priceCurrency' => 'USD',
                ],
                'publisher' => ['@id' => route('home').'#organization'],
            ],
        ]);
    }

    /**
     * @param  array<int, array<string, mixed>>  $components
     * @return array<string, mixed>
     */
    public function components(array $components): array
    {
        $items = [];

        foreach (array_values($components) as $position => $component) {
            $slug = Arr::get($component, 'slug');

            if (! is_string($slug)) {
                continue;
            }

            $items[] = [
                '@type' => 'ListItem',
                'position' => $position + 1,
                'name' => Arr::get($component, 'title'),
                'description' => Arr::get($component, 'summary'),
                'url' => route('docs.show', ['path' => 'components/'.$slug]),
            ];
        }

        return $this->graph([
            $this->organization(),
            [
                '@type' => 'ItemList',
                '@id' => route('components.index').'#components',
                'name' => 'Firstlight UI components',
                'description' => 'Native form, selection, display, and action controls Firstlight provides for NativePHP, each rendered as SwiftUI on iOS and Jetpack Compose on Android.',
                'numberOfItems' => count($items),
                'itemListElement' => $items,
            ],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function documentation(string $title, string $description, string $slug): array
    {
        $url = $slug === 'index'
            ? route('docs.show')
            : route('docs.show', ['path' => $slug]);

        $breadcrumbs = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Firstlight UI', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Documentation', 'item' => route('docs.show')],
        ];

        if ($slug !== 'index') {
            $breadcrumbs[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $title, 'item' => $url];
        }

        return $this->graph([
            $this->organization(),
            [
                '@type' => 'TechArticle',
                '@id' => $url.'#article',
                'headline' => $title,
                'description' => $description !== '' ? $description : 'Firstlight UI documentation for NativePHP developers.',
                'url' => $url,
                'inLanguage' => 'en',
                'isPartOf' => [
                    '@type' => 'WebSite',
                    'name' => 'Firstlight UI',
                    'url' => route('home'),
                ],
                'about' => ['@id' => route('home').'#software'],
                'publisher' => ['@id' => route('home').'#organization'],
                'proficiencyLevel' => 'Expert',
            ],
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => $breadcrumbs,
            ],
        ]);
    }

    /**
     * @param  array<int, array{question: string, answer: string}>  $faqs
     * @return array<string, mixed>
     */
    public function comparison(string $title, string $description, array $faqs): array
    {
        return $this->graph([
            $this->organization(),
            [
                '@type' => 'WebPage',
                '@id' => route('comparison').'#page',
                'name' => $title,
                'description' => $description,
                'url' => route('comparison'),
                'inLanguage' => 'en',
                'about' => ['@id' => route('home').'#software'],
                'publisher' => ['@id' => route('home').'#organization'],
            ],
            [
                '@type' => 'FAQPage',
                '@id' => route('comparison').'#faq',
                'mainEntity' => array_map(
                    fn (array $faq): array => [
                        '@type' => 'Question',
                        'name' => $faq['question'],
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => $faq['answer'],
                        ],
                    ],
                    $faqs,
                ),
            ],
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Firstlight UI', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => $title, 'item' => route('comparison')],
                ],
            ],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function organization(): array
    {
        return [
            '@type' => 'Organization',
            '@id' => route('home').'#organization',
            'name' => 'Firstlight UI',
            'url' => route('home'),
            'email' => 'team@firstlightui.dev',
            'sameAs' => [self::PACKAGE_REPOSITORY],
        ];
    }

    /**
     * @param  array<int, array<string, mixed>>  $nodes
     * @return array<string, mixed>
     */
    private function graph(array $nodes): array
    {
        return [
            '@context' => 'https://schema.org',
            '@graph' => $nodes,
        ];
    }
}
