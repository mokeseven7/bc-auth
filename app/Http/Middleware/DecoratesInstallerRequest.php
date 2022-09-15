<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DecoratesInstallerRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->merge(
            [
                'installer' => [
                    'client_id' => config('commerce.client_id'),
                    'client_secret' => config('commerce.client_secret'),
                    'redirect_uri' => config('commerce.redirect_url'),
                    'grant_type' => 'authorization_code',
                    'code' => $request->input('code'),
                    'scope' => $request->input('scope'),
                    'context' => $request->input('context'),
                ] 
            ]
        );

        return $next($request);

    }
}
