<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Like;
use App\Models\Bookmark;
use App\Models\Image;

class Story extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'stories_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'stories_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function getTotalCommentAttribute()
    {
        return $this->comments()->where('status', config('number.one'))->count();
    }

    public function getTotalLikeAttribute()
    {
        return $this->likes()->count();
    }
}
