<?php

namespace App\Http\Controllers;

use App\DocumentationUnavailable;
use App\GitHubDocumentation;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(GitHubDocumentation $documentation): Response
    {
        $urls = [
            ['location' => route('home'), 'priority' => '1.0'],
            ['location' => route('components.index'), 'priority' => '0.9'],
            ['location' => route('comparison'), 'priority' => '0.9'],
            ['location' => route('docs.show'), 'priority' => '0.9'],
        ];

        try {
            foreach ($documentation->slugs() as $document) {
                if ($document['slug'] === 'index') {
                    continue;
                }

                $urls[] = [
                    'location' => route('docs.show', ['path' => $document['slug']]),
                    'priority' => '0.8',
                ];
            }
        } catch (DocumentationUnavailable $exception) {
            report($exception);
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
