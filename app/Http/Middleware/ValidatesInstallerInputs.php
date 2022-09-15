<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as BaseResponse;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
class ValidatesInstallerInputs
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
        if($request->missing('code') || $request->missing('scope') || $request->missing('context')){
            
            return response()->json([
                'message' => 'Missing Required Properties', 
                'code' => $request->input('code'), 
                'scope' => $request->input('scope'), 
                'context' => $request->input('scope')
            ], 400);

        }


        return $next($request);

    }
}
