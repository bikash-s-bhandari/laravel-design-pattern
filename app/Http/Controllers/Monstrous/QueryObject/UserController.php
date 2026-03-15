<?php

namespace App\Http\Controllers\Monstrous\QueryObject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Queries\ActiveUsersQuery;
use App\Queries\UserIndexQuery;
use App\DTOs\UserFiltersDTO;

class UserController extends Controller
{
    public function __construct(
        private ActiveUsersQuery $query
    ) {}

    public function index()
    {
       return response()->json([
        'message' => 'Active users',
        'data' => $this->query->paginate(20),
       ]);
    }

    //
    public function index2(Request $request)
    {
        $filters = UserFiltersDTO::fromRequest($request);

        $users = (new UserIndexQuery($filters))
                    ->paginate(20);

        return response()->json([
            'message' => 'Active users',
            'data' => $users,
        ]);
    }
}
