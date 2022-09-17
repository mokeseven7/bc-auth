<?php

namespace App\Http\Controllers\Hello;

use Illuminate\Http\Request;

class HelloSignOauthController extends \App\Http\Controllers\Controller
{
    public function callback(){
        return response()->json([], 201);
    }
}
