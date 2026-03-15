<?php

namespace App\Http\Controllers\Monstrous\QueryObject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Queries\ActiveUsersQuery;

class AdminUserController extends Controller
{
    public function __construct(
        //same active users query object reuse gareko
        private ActiveUsersQuery $query
    ) {}

    public function index()
    {
        return response()->json([
            'message' => 'Active users',
            'data' => $this->query->paginate(20),
        ]);
    }
}
