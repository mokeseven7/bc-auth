<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OAuthController extends Controller {

    /**
     * GET request from BigCommerce to your app (triggered by merchant clicking Install) containing:
     * code client_id client_secret scopes
     * 
     * @param \Illuminate\Http\Request $request 
     * @return void 
     */
    public function install(Request $request){
        
        $response = Http::withOptions(['debug' => true])->post('https://login.bigcommerce.com/oauth2/token', [
            'client_id' => config('commerce.client_id'),
            'client_secret' => config('commerce.client_secret'),
            'redirect_uri' => env('APP_URL') . '/auth/install',
            'grant_type' => 'authorization_code',
            'code' => $request->input('code'),
            'scope' => $request->input('scope'),
            'context' => $request->input('context'),
        ]);


        if($response->ok()){
            app('log')->debug('BC Install Response', ['response' => $response->json()]);
        }else{
            app('log')->debug('BC Install Response', ['response' => $response->json()]);
        }

        // If the merchant installed the app via an external link, redirect back to the success page
        if ($request->has('external_install')) {
            return redirect('https://login.bigcommerce.com/app/' . config('commerce.client_id') . '/install/succeeded');
        }

        return redirect('/');
    }


    public function load(){

    }

    public function remove(){

    }

}