<?php

namespace App\Http\Controllers;

use App\DocumentationUnavailable;
use App\GitHubDocumentation;
use Illuminate\Http\Response;

class LlmsTextController extends Controller
{
    public function __invoke(GitHubDocumentation $documentation): Response
    {
        try {
            $content = $documentation->llmsText();
        } catch (DocumentationUnavailable $exception) {
            report($exception);

            return response('Firstlight UI documentation is temporarily unavailable.', 503)
                ->header('Content-Type', 'text/plain; charset=UTF-8');
        }

        return response($content)
            ->header('Content-Type', 'text/plain; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=900');
    }
}
