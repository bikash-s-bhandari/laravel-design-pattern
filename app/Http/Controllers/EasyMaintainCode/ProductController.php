<?php

namespace App\Http\Controllers\EasyMaintainCode;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Order;
use App\Models\User;

class ProductController extends Controller
{
    // Bad Code
    public function orders($u, $t)
    {
        $r = DB::table('orders')
            ->where('user_id', $u)
            ->where('status', $t)->get();
    }

    // Good code meaningful name
    public function getOrdersByStatus(
        int $userId,
        string $status
    ): Collection {
        return Order::query()
            ->forUser($userId)
            ->withStatus($status)
            ->get();
    }


    /*
    Method name check() vague xa

    $u unclear variable

    Magic number 1

    Too many responsibilities inside one method

    Boolean logic readable xaina

    */
    public function check($id)
    {
        $u = User::find($id);

        if (!$u) {
            return false;
        }

        if ($u->status == 1 && $u->email_verified_at != null && $u->deleted_at == null) {
            return true;
        }

        return false;
    }

    /*


    Method name clearly expresses intent

    Small reusable methods

    No magic numbers

    Easy to test

    Follows SRP

    Future change friendly

    */
    public function isUserEligibleForLogin(int $userId): bool
    {
        $user = User::find($userId);

        if (!$user) {
            return false;
        }

        return $this->isActive($user)
            && $this->isEmailVerified($user)
            && !$this->isSoftDeleted($user);
    }

    private function isActive(User $user): bool
    {
        return $user->status === User::STATUS_ACTIVE;
    }

    private function isEmailVerified(User $user): bool
    {
        return !is_null($user->email_verified_at);
    }

    private function isSoftDeleted(User $user): bool
    {
        return !is_null($user->deleted_at);
    }

    public function getTotalPriceForActiveItems()
    {
        $items = collect([
            (object)['price' => 100, 'quantity' => 2, 'active' => true],
            (object)['price' => 50,  'quantity' => 1, 'active' => false],
            (object)['price' => 200, 'quantity' => 3, 'active' => true],
        ]);

        //bad code

        //return $items->filter(fn($i) => $i->active)->map(fn($i) => $i->price)->sum();

        // ✅ Readable code — break it into steps
        $activeItems = $items->filter(fn($item) => $item->active);
        $prices      = $activeItems->map(fn($item) => $item->price);
        return $prices->sum();
    }


    // Before — messy code गगगगगगगगग
    // public function getActiveUsers()
    // {
    //     //return User::where('status', 1)->get(); // old code
    //     $users = User::where('is_active', true)->where('deleted_at', null)->get();
    //     //foreach ($users as $user) { // unused loop
    //     // echo $user->name;
    //     //}
    //     $res = [];
    //     foreach ($users as $u) {
    //         $res[] = $u;
    //     }
    //     return $res;
    // }
    // After — same area clean गगगगगग
    public function getActiveUsers(): Collection
    {
        return User::active() // Local scope use
            ->whereNull('deleted_at')
            ->get();
    }
}
