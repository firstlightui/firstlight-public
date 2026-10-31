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
        - Features: The complete component catalogue, all PHP extensions
          (ValidatesFields, SubmitsForms, AuthorizesActions, PaginatesLists,
          DestroysListItems), the app recipes, and the Laravel Boost
          guideline and skills
        - Support: Community, via GitHub issues

        ## Install

        ```
        composer require firstlightui/nativephp
        ```

        Requires NativePHP Mobile ^4.7 and Mobile UI ^0.9.
        Build your screens with `FirstlightUI\NativeComponent` and use Firstlight
        controls in Blade.

        ## Status

        Firstlight UI 1.0.0 is the first stable release. It has been tested on
        physical iOS and Android devices, including VoiceOver on iOS. Spoken
        TalkBack output and long-running performance tests have not been
        recorded yet.

        ## Links

        - Home: {$this->url('home')}
        - Documentation: {$this->url('docs.show')}
        - Compatibility notes: {$this->url('docs.show')}/reference/compatibility
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
