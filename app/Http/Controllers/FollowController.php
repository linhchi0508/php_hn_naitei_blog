<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function listFollower()
    {
        $users = User::join('follows', 'follows.user_id', '=', 'users.id')
            ->where('follows.following_id', Auth::id())
            ->select('users.*')
            ->get();
        $total = Follow::where("following_id", Auth::id())->count();

        return view('homepage.list_follower', compact('users', 'total'));
    }

    public function listFollowing()
    {
        $users = User::join('follows', 'follows.following_id', '=', 'users.id')
            ->where('follows.user_id', Auth::id())
            ->select('users.*')
            ->get();
        $total = Auth::user()->follows->count();

        return view('homepage.list_following', compact('users', 'total'));
    }

    public function follow($id)
    {
        $followDataArray = array(
            "user_id" => Auth::id(),
            "following_id" => $id,
        );
        Follow::create($followDataArray);

        return response()->json([
            'success' =>  trans('message.unfollow_success')
        ]);
    }

    public function destroy($id)
    {
        Follow::where('user_id', $id)
            ->where('following_id', Auth::id())->delete();

        return response()->json([
            'success' =>  trans('message.unfollow_success')
        ]);
    }
}
