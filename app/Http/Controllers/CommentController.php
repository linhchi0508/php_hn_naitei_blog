<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Carbon\Carbon;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $comment = Comment::create($data);

        $created_time = $comment->created_at;
        $createAt = Carbon::parse($comment->created_at);
        $time = $createAt->format('Y-m-d H:m:s');
        $userName = Auth::user()->username;
        $userImg = (Auth::user()->images)[0]->image_url;

        if ($comment) {
            return response()->json([
                'success' => 'success',
                'content' => $data['content'],
                'id' => $comment->id,
                'user_id' => Auth::id(),
                'story_id' => $data['stories_id'],
                'parent' => $data['parent'],
                'time' => $time,
                'user_name' => $userName,
                'user_img' => $userImg,
            ]);
        } else {
            return response('fail');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $comment = Comment::findOrFail($id);
        $comment->content = $data['content'];
        $comment->save();

        return response()->json([
            'success' => 'success',
            'content' => $data['content'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment) {
            $comment->delete();
            $child = Comment::where('parent', $id)->delete();
            return response()->json([
                'message' => 'success',
            ]);
        } else {
            return response()->json([
                'message' => 'fail',
            ]);
        }
    }
}
