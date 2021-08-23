<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Story;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'parent',
    ];

    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}
