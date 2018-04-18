<?php
/**
 * Brain Train - Find the job you love!
 * Copyright (c) Brain Train Kenya. All Rights Reserved
 *
 * Website: http://www.braintrainke.com
 *
 * CODED WITH LOVE
 * ---------------
 * 	@author : Wanekeya Sam
 *  Title   : Full-stack Developer
 * 	created	: 01 September, 2017
 *	version : 1.0
 * 	website : https://www.wanekeyasam.co.ke
 *	Email   : contact@wanekeyasam.co.ke
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HtmlMinify
{
    /**
     * @param $request
     * @param Closure $next
     * @param int $cache
     * @return mixed
     */
    public function handle($request, Closure $next, $cache = 1)
    {
        $response = $next($request);

        // Don't minify the HTML in development environment
        if (config('settings.activation_minify_html') == 0) {
            return $response;
        }

        // Minify HTML
        $content = $response->getContent();
        $search = array(
            '/\>[^\S ]+/us',    // strip whitespaces after tags, except space
            '/[^\S ]+\</us',    // strip whitespaces before tags, except space
            '/(\s)+/us',        // shorten multiple whitespace sequences
        );
        $replace = array(
            '>',
            '<',
            '\\1',
        );
        $buffer = preg_replace($search, $replace, $content);

        return $response->setContent($buffer);
    }
}
