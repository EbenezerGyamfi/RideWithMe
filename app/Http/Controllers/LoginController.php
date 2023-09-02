<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserNeedsToLogIn;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function store(Request $request)
    {

        //perform login

        $request->validate([
            'phone_number' => 'required'
        ]);


        $user = User::firstOrCreate([
            'phone_number' => $request->phone_number
        ]);



        if (!$user) {
            return response()->json(['message' => 'The Phone number provided is no valid'],401);
        }


        $user->notify(new UserNeedsToLogIn());


        return response()->json(['message' => 'Text message notification sent']);
    }


    public function verify(Request $request)
    {

        $request->validate([
            'phone_number' => 'required',
            'login_code' => 'numeric'
        ]);


        $user = User::where('phone_number', $request->phone_number)
            ->where('login_code', $request->login_code)->first();

        if ($user) {

            $user->update([
                'login_code'  => null
            ]);


            return $user->createToken($request->login_code)->plainTextToken;
        }


        return response()->json([
            'message' => 'Invalid Verification'
        ], 401);
    }
}
