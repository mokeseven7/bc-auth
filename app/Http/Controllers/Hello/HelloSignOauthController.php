<?php

namespace App\Http\Controllers\Hello;

use Illuminate\Http\Request;

class HelloSignOauthController extends \App\Http\Controllers\Controller
{
    public function callback(Request $request){
        app('log')->debug('Hello Event', ['request' => $request]);
        return response()->json([], 201);
    }
}
