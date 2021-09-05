<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Story;
use App\Models\User;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'status',
        'parent',
        'stories_id',
        'users_id',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class, 'stories_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
