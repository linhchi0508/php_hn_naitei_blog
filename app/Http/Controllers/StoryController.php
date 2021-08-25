<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Image;
use App\Models\Category;
use App\Http\Controllers\Auth;
use App\Http\Requests\StoryRequest;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::paginate(config('paginate.list_story'));
        $categories = Category::all();

        return view('homepage.index', compact('stories', 'categories'));
    }

    public function create()
    {
        return view('homepage.index');
    }

    public function store(StoryRequest $request)
    {
        $storyDataArray = array(
            "categories_id" => $request->category,
            "content" => $request->content,
            "title" => $request->title,
            "status" => $request->status,
            "users_id" => Auth::id(),
        );
        $story = Story::create($storyDataArray);
        if(count($request->photos)>0){
            foreach ($request->photos as $photo) {
                $newImageName = 'storage/image/' .uniqid() . '.' . $photo->extension();
                $photo->move(public_path('storage/image'), $newImageName);
                $story->images()->create([
                   'image_url' => $newImageName,
                ]);
            }
        }

        return redirect()->route('stories.index')->with('message', trans('message.create_success'));
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
        $categories = Category::all();

        return view('homepage.story_edit', compact('story', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $story = Story::find($id);
        $story->title = $request->title;
        $story->content = $request->content;
        $story->status = $request->status;
        $story->save();
        if($request->photos != null) {
            $story->images()->delete();
            if(count($request->photos)>0){
                foreach ($request->photos as $photo) {
                    $newImageName = 'storage/image/' .uniqid() . '.' . $photo->extension();
                    $photo->move(public_path('storage/image'), $newImageName);
                    $story->images()->create([
                        'image_url' => $newImageName,
                    ]);
                }
            }
        }
           
        return redirect()->route('stories.show')->with('message', trans('message.update_success'));
    }


    public function destroy($id)
    {
        $story = Story::findorFail($id);
        $story->images()->delete();
        $story->delete();
        
        return redirect()->back()->with('message',"Delete thành công");
    }

}
