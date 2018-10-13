<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'highlights',
        'author',
        'publish_date',
        'category_id',
        'category_name',
        'image',
    ];

    protected $dates = ['deleted_at'];

    public function categories()
    {
        return $this->hasMany('App\Categories');
    }
}
