<?php

namespace App\Http\Controllers\Adapters;

use App\Http\Controllers\Controller;
use App\Services\Book;
use App\Services\Person;
use App\Adapters\KindleAdapter;
use App\Services\Kindle;
use App\Contracts\BookInterface;

class BookController extends Controller
{
    public function __construct(
        private Person $person,

    ) {}

    public function readWithBinding(BookInterface $book)
    {
        $result = $this->person->read($book);

        return response()->json([
            'status'  => 'success',
            'reader'  => 'Person',
            'device'  => class_basename($book),
            'actions' => $result,
        ]);
    }


    //manual Injection for reading book
    public function readBook()
    {
        $book   = new Book();
        $result = $this->person->read($book);

        return response()->json([
            'status'  => 'success',
            'device'  => 'Physical Book',
            'actions' => $result,
        ]);
    }

    //manual Injection for reading kindle
    public function readKindle()
    {
        $kindle = new KindleAdapter(new Kindle());
        $result = $this->person->read($kindle);

        return response()->json([
            'status'  => 'success',
            'device'  => 'Kindle',
            'actions' => $result,
        ]);
    }

}
