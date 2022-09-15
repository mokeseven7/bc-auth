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
        app('log')->debug('payload', ['payload' => $payload]);
        
        $decoded = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $payload)[1]))));

        return $decoded;



    }


    public function validate_signature(){

    }
}