<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Story;
use App\Models\Follow;
use App\Models\User;
use App\Models\Category;
use Session;
use App\Models\Image;
use App\Models\Bookmark;
use App\Models\Like;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stories = Story::with(['comments', 'user.images', 'images'])
            -> where('status', '=', 'public')
            ->orderByRaw('created_at DESC')
            ->get();
        $users = User::whereNotIn('id', Follow::select('following_id')->where('user_id', '=', Auth::id())->get())
            ->where('id', '!=', Auth::id())
            ->orderByRaw('created_at DESC')
            ->limit(config('ad.limit'))
            ->get();
        $categories = Category::all();

        return view('homepage.index', compact('stories', 'categories', 'users'));
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }

    public function viewProfile()
    {
        $stories = Story::with(['comments', 'user.images', 'images'])
            -> where('users_id', '=', Auth::id())
            ->orderByRaw('created_at DESC')
            ->get();

        return view('homepage.profile', compact('stories'));
    }

    public function editProfile()
    {
        return view('homepage.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->save();

        $newImageUrl = 'storage/image/' . uniqid() . '.' . $data['image']->extension();
        Storage::disk('public')->put($newImageUrl, file_get_contents($data['image']));

        if (count($user->images) != config('number.zero')) {
            $image = $user->images[0];
            $image->image_url = $newImageUrl;
            $image->save();
        } else {
            $user->images()->create([
                'image_url' => $newImageUrl,
            ]);
        }

        return redirect("/");
    }


    public function listUser()
    {
        $users = User::where('status', config('ad.one'))
            ->where('id', '!=', Auth::id())
            ->get();

        return view('homepage.list_user', compact('users'));
    }

    public function userDetail($id)
    {
        $user = User::findorFail($id);
        $stories = $user->stories
            -> where('status', '=', 'public');
        $follower = Auth::user()->follows
            ->where('following_id', $id);
        
        return view('homepage.user_detail', compact('stories', 'user', 'follower'));
    }

    public function bookmark($id)
    {
        $data = new Bookmark();
        $data->users_id = Auth::id();
        $data->stories_id = $id;
        $bookmarked = Auth::user()->bookmarks->where('stories_id', $id);
        if (count($bookmarked) > config('number.zero')) {
            return response()->json([
                'bool' => false,
            ]);
        } else {
            $data->save();
        }

        return response()->json([
            'bool' => true,
        ]);
    }

    public function listBookmark()
    {
        $bookmark = Bookmark::with(['story', 'user'])->where('users_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('homepage.list_bookmark', compact('bookmark'));
    }

    public function like($id)
    {
        $data = new Like();
        $data->user_id = Auth::id();
        $data->story_id = $id;
        $like = Auth::user()->likes->where('story_id', $id);
        if (count($like) > 0) {
            return response()->json([
                'bool' => false,
            ]);
        } else {
            $data->save();
        }

        return response()->json([
            'bool' => true,
        ]);
    }
}
