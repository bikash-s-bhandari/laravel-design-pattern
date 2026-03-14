<?php

namespace App\Services\Monstrous;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\DTOs\RegisterUserDTO;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Events\UserRegistered;

class UserService
{
    public function register(RegisterUserDto $dto): User
    {
        $user = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
            'company_id' => 1,
       
        ]);

        // side effects
        Mail::to($user)->send(new WelcomeEmail($user));
        event(new UserRegistered($user));

        return $user;
    }
}
