<?php

namespace App\Http\Controllers\EloquentPerformance;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Login;
use App\Models\Feature;

class UserController extends Controller
{
    /**
     * BAD: Circular relationship without setRelation.
     * User -> posts -> user causes N+1 when we access $post->user for each post.
     * Each post triggers an extra query to load its user (even though we already have that user).
     */
    public function badCircularRelationship()
    {
        DB::enableQueryLog();

        $users = User::with('posts')->take(10)->get();

        // Accessing $post->user for each post triggers a new query per post (N+1)
        $result = $users->map(function ($user) {
            return $user->posts->map(fn ($post) => [
                'post_title' => $post->title,
                'author_name' => $post->user->name, // BAD: extra query per post
            ]);
        })->flatten(1);

        $queries = DB::getQueryLog();
        DB::disableQueryLog();

        return response()->json([
            'message' => 'Bad: circular relationship causes N+1 when accessing post->user',
            'query_count' => count($queries),
            'data' => $result,
        ]);
    }

    /**
     * GOOD: Break the circular relationship with setRelation.
     * After loading users with posts, set each post's user relation to the parent user.
     * No extra queries when we access $post->user.
     */
    public function goodCircularRelationship()
    {
        DB::enableQueryLog();

        $users = User::with('posts')->take(10)->get();

        // Set each post's user to the parent user we already have (no extra query)
        $users->each(function ($user) {
            $user->posts->each(fn ($post) => $post->setRelation('user', $user));
        });

        // Now accessing $post->user uses the set relation — no N+1
        $result = $users->map(function ($user) {
            return $user->posts->map(fn ($post) => [
                'post_title' => $post->title,
                'author_name' => $post->user->name, // GOOD: uses set relation, no query
            ]);
        })->flatten(1);

        $queries = DB::getQueryLog();
        DB::disableQueryLog();

        return response()->json([
            'message' => 'Good: setRelation avoids N+1 by reusing parent user on each post',
            'query_count' => count($queries),
            'data' => $result,
        ]);
    }
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

        // $users = User::query()->withLastLogin()
        //     // ->withCasts(['last_login_at' => 'datetime'])//carbon ma convert garxa
        //     ->get();

        $users = User::with('lastLogin')->get();

        //bad example, 3 queries to get the status count
        // $activeStatus=Feature::where('status', 'requested')->count();
        // $inactiveStatus=Feature::where('status', 'approved')->count();
        // $suspendedStatus=Feature::where('status', 'rejected')->count();

        //single query to get the status count
        $status = Feature::toBase()
            ->selectRaw("count(case when status = 'requested' then 1 end) as requested_count")
            ->selectRaw("count(case when status = 'approved' then 1 end) as approved_count")
            ->selectRaw("count(case when status = 'rejected' then 1 end) as rejected_count")
            ->first();


        //yo subquery lai scope ma add garne
        return view('users.index', compact('users',  'status'));
    }


    public function show(Feature $feature)
    {
        //this is bad
        //$feature->load('comments.user','comments.feature.comments');

        // Yesle 'comments.user' relation haru eager load garxa, jasle gare comment sanga related user pani pre-load hunxa, so N+1 query problem hudaina.
        $feature->load('comments.user');

        // Yesle comments collection ko pratek comment ma 'feature' relation lai manually setRelation() garera $feature nai set garxa, jasle gare comment batw access gareko feature le reference pauncha.
        $feature->comments->each->setRelation('feature', $feature);




        return view('features.show', compact('feature'));

    }



    public function search()
    {

        // $users = User::query()->with('company')->search(request()->search)->limit(10)->get();
        // $users = User::query()->with('company')->searchCompany(request()->search)->limit(10)->get();
        $users = User::query()->with('company')->searchCompanyWithIndex(request()->search)->limit(10)->get();

        return response()->json([
            'message' => 'Users with companies',
            'data' => $users,
        ]);

    }
}
