<?php

namespace App\Adapters;

use App\Contracts\BookInterface;
use App\Services\Kindle;

class KindleAdapter implements BookInterface
{
    private Kindle $kindle;

    public function __construct(Kindle $kindle)
    {
        $this->kindle = $kindle;
    }


    public function open()
    {
        return $this->kindle->turnOn();
    }


    public function turnPage()
    {
        return $this->kindle->pressNextPageButton();
    }
}
