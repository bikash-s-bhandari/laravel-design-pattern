<?php

namespace App\Services;

use App\Contracts\EReaderInterface;

class Kindle implements EReaderInterface
{
    public function turnOn()
    {
        return 'Turning on the Kindle...';
    }

    public function pressNextPageButton()
    {
        return 'Pressing the next page button...';
    }
}
