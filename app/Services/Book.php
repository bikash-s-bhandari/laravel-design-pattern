<?php

namespace App\Services;

use App\Contracts\BookInterface;

class Book implements BookInterface
{
    public function open()
    {
        return 'Opening the book...';
    }

    public function turnPage()
    {
        return 'Turning the page...';
    }
}
