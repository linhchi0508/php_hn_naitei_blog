<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        if (Gate::allows('is-active')) {
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
        } else {
            abort(403);
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
        $this->authorize('update', $comment);

        if ($comment != null) {
            $comment->content = $data['content'];
            $comment->save();

            return response()->json([
                'success' => 'success',
                'content' => $data['content'],
            ]);
        } else {
            return response()->json([
                'success' => 'fail',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cmt = Comment::findOrFail($id);
        $this->authorize('delete', $cmt);

        $comment = Comment::withTrashed()->where('id', $id)->forceDelete();
        if ($comment != null) {
            $child = Comment::where('parent', $id);
            if ($child != null) {
                Comment::withTrashed()->where('parent', $id)->forceDelete();
            }

            return response()->json([
                'message' => 'success',
            ]);
        } else {
            return response()->json([
                'message' => 'fail',
            ]);
        }
    }

    public function hideComment($id)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-inspector')) {
            $comment = Comment::findOrFail($id);
            $child = Comment::where('parent', $id);
            if ($comment != null) {
                $comment->delete();
                if ($child != null) {
                    $child->delete();
                }

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
