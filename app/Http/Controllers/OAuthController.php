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
        
        if($response->ok()){
            $auth->create_session($response);
        }else{
            app('log')->debug('INSTALL FAIL', ['response' => $response->json()]);
        }



        // If the merchant installed the app via an external link, redirect back to the success page
        if ($request->has('external_install')) {
            return redirect('https://login.bigcommerce.com/app/' . config('commerce.client_id') . '/install/succeeded');
        }

        return view('welcome');
    }


    public function load(Request $request, AppAuthentication $auth){
        return view('welcome');
    }

    public function remove(){

    }

}