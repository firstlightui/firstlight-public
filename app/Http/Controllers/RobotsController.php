<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    /**
     * Search and answer engines that retrieve pages in order to cite them.
     *
     * These are listed explicitly so the intent is legible: Firstlight wants to be
     * readable, quotable, and citable by AI assistants, which is how most of its
     * audience discovers Laravel and NativePHP packages in the first place.
     *
     * @var array<int, string>
     */
    private const CITING_AGENTS = [
        'GPTBot',
        'ChatGPT-User',
        'OAI-SearchBot',
        'PerplexityBot',
        'Perplexity-User',
        'ClaudeBot',
        'Claude-User',
        'Claude-SearchBot',
        'anthropic-ai',
        'Google-Extended',
        'Bingbot',
        'Applebot',
        'Applebot-Extended',
    ];

    public function __invoke(): Response
    {
        $lines = ['User-agent: *', 'Allow: /', ''];

        foreach (self::CITING_AGENTS as $agent) {
            $lines[] = 'User-agent: '.$agent;
            $lines[] = 'Allow: /';
            $lines[] = '';
        }

        $lines[] = 'Sitemap: '.route('sitemap');
        $lines[] = '';

        return response(implode("\n", $lines))
            ->header('Content-Type', 'text/plain; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=86400');
    }
}
