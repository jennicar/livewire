<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;

class CheckRedirects
{
    public function handle(Request $request, Closure $next)
    {
        $requestUri = $request->getRequestUri();

        $redirect = cache()->remember(
            "redirect.$requestUri",
            60 * 60,
            fn() => Redirect::where('origin', $requestUri)->first() ?? 'no-match'
        );

        if (is_object($redirect) && get_class($redirect) === Redirect::class) {
            $redirect->hits++;
            $redirect->last_hit_at = now();
            $redirect->save();

            return redirect($redirect->destination, $redirect->status_code);
        }

        return $next($request);
    }
}
