<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        if (Gate::denies('user-active')) {
            abort(403);
        }
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
        if (Gate::denies('user-active')) {
            abort(403);
        }
        $user = Auth::user()->follows->where('following_id', $id)->first();
        $user->delete();

        return response()->json([
            'success' =>  trans('message.unfollow_success')
        ]);
    }
}
