<?php

namespace App\Http\Controllers\Monstrous;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Events\UserRegistered;

class BadExampleController extends Controller
{
    public function register(Request $request)
    {
        // validation
        $request->validate([
            'name'  => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // business logic
        $user = User::create([
            'name'     => ucwords($request->name),
            'email'    => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role'     => 'member',
        ]);

        // side effects
        Mail::to($user)->send(new WelcomeEmail($user));
        event(new UserRegistered($user));

        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user,
        ]);
    }
}
