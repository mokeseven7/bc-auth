<?php

namespace App\Http\Controllers;

use App\Service\Commerce\AppAuthentication;
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
    public function install(Request $request, AppAuthentication $auth){
        
        $response = Http::token($request->input('installer'));

        if($response->ok){
            $auth->create_session($response);
        }

        if($response->ok()){
            $data = $response->json();

            $request->session()->put('store_hash', $data['context']);
            $request->session()->put('access_token', $data['access_token']);
            $request->session()->put('user_id', $data['user']['id']);
            $request->session()->put('user_email', $data['user']['email']);

            app('log')->debug('INSTALL SUCCESS', ['data' => $data, 'request' => $request]);

        }else{
            app('log')->debug('INSTALL FAIL', ['response' => $response->json()]);
        }

        // If the merchant installed the app via an external link, redirect back to the success page
        if ($request->has('external_install')) {
            return redirect('https://login.bigcommerce.com/app/' . config('commerce.client_id') . '/install/succeeded');
        }

        return view('welcome');
    }


    public function load(Request $request){
        $signed = $request->input('signed_payload');

        app('log')->debug('signed_payload', ['signed' => $signed, 'request' => $request]);

        return view('welcome');
    }

    public function remove(){

    }

}