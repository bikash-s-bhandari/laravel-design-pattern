<?php

namespace App\Http\Controllers\Monstrous;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Forms\RegisterUserForm;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Events\UserRegistered;

class GoodExampleController extends Controller
{
    public function register(Request $request)
    {
        $user = (new RegisterUserForm($request))
            ->validate()
            ->save();

        Mail::to($user)->send(new WelcomeEmail($user));
        event(new UserRegistered($user));

        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user,
        ]);
    }
}
