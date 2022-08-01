<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\EventListener\ValidateRequestListener;

class UserAuth extends Controller
{

    public function login(Request $reguest, User $user){

        $validator=Validator( $reguest->validate( [
            'phone_number' => 'required|exists:users,id|unique:user',]));

        if($validator->fails()){
            $user = new User();
            $user->phone_number = $user->get('phone_number');
            $isSaved = $user->save();
            if ($isSaved) {
                return response()->json(['message' => $isSaved ? "Saved successfully" : "Failed to save"], $isSaved ? 201 : 400);
            } else {
                return response()->json(['message' => "Failed to save"], 400);
            }
            $user->confirm();
        }    
            
        else{
            $user->confirm();
        }
            

    }

    public function confirm($message, $recipients,$user){

        if(!$user->status_active=0){
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new User($account_sid, $auth_token);
        $client->messages->create(
            $recipients,
            [
                'from' => $twilio_number,
                'body' => $message
            ]
        );
        }
        $user->status_active=1;

    }

    public function logout(User $user){

        $user->status_active = 0;

    }

}
