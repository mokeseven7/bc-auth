<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowsIframes
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
        $one = explode('.', $request->input('signed'));
        $two = str_replace('-','+', $one[1]);
        $three = str_replace('_', '/', $two);
        $four = base64_decode($three);
        $five = \json_decode($four);


    }
}
