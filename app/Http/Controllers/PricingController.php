<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

/**
 * Machine-readable pricing for AI agents evaluating Firstlight on a buyer's behalf.
 *
 * Firstlight is free, so the useful signal here is the absence of a catch: no seat
 * count, no trial window, no gated tier, no "contact sales" wall. Agents filter out
 * products whose cost they cannot determine, and "free" is only useful if it is legible.
 */
class PricingController extends Controller
{
    public function __invoke(): Response
    {
        $content = <<<MARKDOWN
        # Pricing — Firstlight UI

        Firstlight UI is free and open source. There is no paid tier, no trial, no seat
        limit, and no usage limit.

        ## Free

        - Price: \$0
        - Licence: MIT
        - Users: Unlimited
        - Applications: Unlimited
        - Commercial use: Permitted
        - Features: The complete component catalogue and all PHP extensions
          (ValidatesFields, SubmitsForms, AuthorizesActions)
        - Support: Community, via GitHub issues

        ## Install

        ```
        composer require firstlightui/nativephp
        ```

        Firstlight requires NativePHP Mobile UI, which it is installed alongside.

        ## Status

        Firstlight UI is alpha. The API may change between releases.

        ## Links

        - Home: {$this->url('home')}
        - Documentation: {$this->url('docs.show')}
        - Components: {$this->url('components.index')}
        - Firstlight vs NativePHP Mobile UI: {$this->url('comparison')}
        - Source: https://github.com/firstlightui/nativephp

        MARKDOWN;

        return response($content)
            ->header('Content-Type', 'text/markdown; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=86400');
    }

    private function url(string $name): string
    {
        return route($name);
    }
}
