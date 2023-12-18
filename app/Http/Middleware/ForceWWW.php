<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/*
 * Force WWW Redirection in Production
 *
 * @see config/www.php
 * @note This does not enforce WWW Redirection on admin.*.com domains (HTTP-host that circumvents CDN)
 * @note If www.enabled is true, this middleware will force WWW (example.com -> www.example.com)
 * @note If www.enabled is false, this middleware will force Non-WWW (www.example.com -> example.com)
 * @note If www.enabled is null, this middleware will do nothing (no redirection)
 */
class ForceWWW
{
    public function handle(Request $request, Closure $next)
    {
        $enabled = config('www.enabled');
        if (App::environment() !== 'production' || $enabled === null) {
            return $next($request);
        }

        $url = $request->fullUrl();
        if ($enabled === true && !str_contains($url, '://www.') && !str_contains($url, '://admin.')) {
            // Force WWW
            return redirect(str_replace('://', '://www.', $url), 301);
        } else if ($enabled === false && str_contains($url, '://www.')) {
            // Force Non-WWW
            return redirect(str_replace('://www.', '://', $url), 301);
        }

        return $next($request);
    }
}
