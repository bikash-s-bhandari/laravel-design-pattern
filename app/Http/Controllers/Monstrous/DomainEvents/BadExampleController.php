<?php

namespace App\Http\Controllers\Monstrous\DomainEvents;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class BadExampleController extends Controller
{

    public function store()
    {
        User::create([
            'name'     => 'Bikash',
            'email'    => 'bikash@gmail.com',
            'password' => bcrypt('password'),
        ]);

        event('UserRegistered');

        Mail::send(...);

        // schedule follow-up email
        // update stats
        // payments
    }

}
