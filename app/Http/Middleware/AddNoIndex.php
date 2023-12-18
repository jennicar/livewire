<?php

namespace App\Http\Middleware;

use Closure;

class AddNoIndex
{
    /**
     * Add a HTTP Header to responses that prevents them from being indexed (X-Robots-Tag: "noindex")
     *
     * @note A common use-case of this is XML Sitemaps, which we typically do not want to show in Google Results
     * @note This HTTP Header does not prevent Google from crawling it, just from "indexing" it
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (method_exists($response, 'header')) {
            $response->header('X-Robots-Tag', 'noindex');
        }
        return $response;
    }
}
