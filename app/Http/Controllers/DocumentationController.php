<?php

namespace App\Http\Controllers;

use App\DocumentationUnavailable;
use App\GitHubDocumentation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class DocumentationController extends Controller
{
    public function __invoke(GitHubDocumentation $documentation, ?string $path = null): View|Response
    {
        try {
            $page = $documentation->find($path);
        } catch (DocumentationUnavailable $exception) {
            report($exception);

            return response()->view('errors.docs-unavailable', status: 503);
        }

        abort_if($page === null, 404);

        return view('docs.show', ['documentation' => $page]);
    }
}
