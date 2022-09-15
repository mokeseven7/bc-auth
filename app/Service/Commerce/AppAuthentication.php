<?php

namespace App\Service\Commerce;

use App\Models\Session;

class AppAuthentication {

    public function create_session(\Illuminate\Http\Client\Response $token_response){
        
        $session_data = $token_response->json();
        
        $session = new Session([
            'access_token'      => $session_data['access_token'],
            'scope'             => $session_data['scope'],
            'user_id'           => $session_data['user']['id'],
            'username'          => $session_data['user']['username'],
            'user_email'        => $session_data['user']['email'],
            'context'           => $session_data['context'],
            'account_uuid'      => $session_data['account_uuid'],
        ]);

        $session->save();


        \session('installer_id', $session->id);
    }

    public function decode_signed($payload){
        list($encoded_data, $encoded_signature) = explode('.', $payload, 2);
        
        $data = \base64_decode($encoded_data);
        $signature = \base64_decode($encoded_signature);
       
        $signature_should_match = hash_hmac('sha256', $data, config('commerce.client_secret'), $raw = false);

        //Compare the two signatures using time safe comparison
        if(!hash_equals($signature, $signature_should_match)){

        }

    }


    public function validate_signature(){

    }
}