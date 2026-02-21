<?php
// app/Adapters/Person.php

namespace App\Services;

use App\Contracts\BookInterface;

class Person
{
    // BookInterface मात्र accept गर्छ
    public function read(BookInterface $book)
    {
        echo $book->open()    . PHP_EOL;
        echo $book->turnPage(). PHP_EOL;
    }
}
