<?php

namespace App\Http\Forms;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserForm
{
    public string $name;
    public string $email;
    public string $password;

    public function __construct(private Request $request) {}

    public function validate(): static
    {
        $data = $this->request->validate([
            'name'     => 'required|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // transform data
        $this->name     = ucwords($data['name']);
        $this->email    = strtolower($data['email']);
        $this->password = Hash::make($data['password']);

        return $this;
    }

    public function save(): User
    {
        return User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
            'role'     => 'member',
        ]);
    }
}
