<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoryRequest;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        abort(404);
    }

    public function store(StoryRequest $request)
    {
        if (Gate::allows('is-active')) {
            $storyDataArray = array(
                "categories_id" => $request->category,
                "content" => $request->content,
                "status" => $request->status,
                "users_id" => Auth::id(),
            );
           
            $story = Story::create($storyDataArray);
            if ($request->photos != null) {
                foreach ($request->photos as $photo) {
                    $newImageName = 'storage/image/' .uniqid() . '.' . $photo->extension();
                    $photo->move(public_path('storage/image'), $newImageName);
                    $story->images()->create([
                       'image_url' => $newImageName,
                    ]);
                }
            }
    
            return redirect()->route('home')->with('message', trans('message.create_success'));
        } else {
            abort(403);
        }
    }

    public function show($id)
    {
        $story= Story::findOrFail($id);
        $user = $story->user;

        return view('homepage.story_detail', compact('story', 'user'));
    }

    public function edit($id)
    {
        $story = Story::findOrFail($id);
        $this->authorize('update', $story);
        $categories = Category::all();

        return view('homepage.story_edit', compact('story', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $story = Story::findOrFail($id);
        $this->authorize('update', $story);

        $story->update([
            'content' =>  $request->content,
            'status' => $request->status,
        ]);
        if ($request->photos != null) {
            $story->images()->delete();
            if (count($request->photos) > 0) {
                foreach ($request->photos as $photo) {
                    $newImageName = 'storage/image/' .uniqid() . '.' . $photo->extension();
                    $photo->move(public_path('storage/image'), $newImageName);
                    $story->images()->create([
                        'image_url' => $newImageName,
                    ]);
                }
            }
        }

        return redirect()->route('stories.show', $id)->with('message', trans('message.update_success'));
    }

    public function destroy($id)
    {
        $story = Story::findOrFail($id);
        $this->authorize('delete', $story);

        $story->images()->delete();
        Story::withTrashed()->where('id', $id)->forceDelete();

        return response()->json([
            'success' =>  trans('message.delete_success')
        ]);
    }

    public function hideStory($id)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-inspector')) {
            $story = Story::findOrFail($id)->delete();
            if ($story != null) {
                return response()->json([
                    'message' => 'success',
                ]);
            } else {
                return response()->json([
                    'message' => 'fail',
                ]);
            }
        } else {
            abort(403);
        }
    }
}
