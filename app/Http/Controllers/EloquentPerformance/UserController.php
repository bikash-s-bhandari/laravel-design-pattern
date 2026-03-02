<?php

namespace App\Http\Controllers\EloquentPerformance;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Login;

class UserController extends Controller
{
    public function index()
    {
        // DB::enableQueryLog();
        //$users=User::get();//yesko execution time fast hunxa
        $users = User::select('id', 'name', 'email', 'created_at')->with(['posts:id,title,content,user_id', 'logins:id,user_id,ip_address,created_at'])->orderBy('name', 'asc')->paginate(1000); //order by ko execution time slow hunxa, so indexing garnu pary
        // dd(DB::getQueryLog());

        return view('users.index', compact('users'));
    }

    public function getUsersWithLastLogin()
    {
        // $users = User::with('logins')->get();
        // $users = User::addSelect(['last_login_at' => Login::select('created_at')
        //     ->whereColumn('user_id', 'users.id')->latest()->take(1)])
        //     ->withCasts(['last_login_at' => 'datetime'])//carbon ma convert garxa
        //     ->get();

        $users = User::query()->withLastLogin()
            // ->withCasts(['last_login_at' => 'datetime'])//carbon ma convert garxa
            ->get();


            //yo subquery lai scope ma add garne
        return view('users.index', compact('users'));
    }
}
