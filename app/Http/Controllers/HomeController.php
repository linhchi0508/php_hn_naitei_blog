<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Follow;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Session;

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
            ->orderByRaw('created_at DESC')
            ->get();

        $categories = Category::all();

        return view('homepage.index', compact('stories', 'categories'));
    }

    public function viewProfile()
    {
        $stories = Auth::user()->stories;
        
        return view('homepage.profile', compact('stories'));
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
}
