<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    protected $fillable = [
        'image_url',
    ];
    // protected $guarded = [];
    public function imageable()
    {
        return $this->morphTo();
    }
}
