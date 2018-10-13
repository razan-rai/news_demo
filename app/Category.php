<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'name',
        'display_name',
    ];

    protected $dates = ['deleted_at'];

    public function news()
    {
        return $this->belongsToMany('App\News');
    }
}
