<?php

namespace App\Http\Controllers\Monstrous\MethodParameters;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\ValueObjects\Address;

class OrderController extends Controller
{
    // ❌ Before: 6 loose params
    function createOrder(
        User $user,
        string $street,
        string $city,
        string $state,
        string $zip,
        string $country
    ): Order {
        return Order::create([
            'user_id' => $user->id,
            'street' => $street,
            'city' => $city,
            'state' => $state,
            'zip' => $zip,
            'country' => $country,
        ]);
    }

    // ✅ After: 2 meaningful params
    function createOrderUpdate(User $user, Address $shippingAddress): Order
    {
        return Order::create([
            'user_id'  => $user->id,
            'address'  => $shippingAddress->format(),
            'country'  => $shippingAddress->country,
            'zip'      => $shippingAddress->zip,
            'state'    => $shippingAddress->state,
            'city'     => $shippingAddress->city,
            'street'   => $shippingAddress->street,
        ]);
    }


    public function store()
    {
        // Calling
        $this->createOrderUpdate(User::find(request()->user_id), new Address(
            street: 'Dhangadhi Marg 12',
            city: 'Dhangadhi',
            state: 'Sudurpashchim',
            zip: '10900',
            country: 'NP',
        ));
    }
}
