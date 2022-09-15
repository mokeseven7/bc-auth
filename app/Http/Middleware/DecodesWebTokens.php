<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DecodesWebTokens
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

        if($request->missing('signed_payload')){
            return response()->json(['message' => 'Missing Required Properties'], 400);
        }

        list($encoded_data, $encoded_signature) = explode('.', $request->input('signed_payload'), 2);
        
        $data = \base64_decode($encoded_data);
        $signature = \base64_decode($encoded_signature);
       
        $signature_should_match = hash_hmac('sha256', $data, config('commerce.client_secret'), $raw = false);

        //Compare the two signatures using time safe comparison
        if(!hash_equals($signature, $signature_should_match)){
            return response()->json(['message' => 'Not Authorized To Perform Action'], 401);
        }

        return $next($request);

    }
}
