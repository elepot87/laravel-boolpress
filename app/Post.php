<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //MASS ASSIGNEMENT

    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'cover',
    ];

    // RELATION WITH CATEGORIES
    // posts - categories
    public function category() {
        return $this->belongsTo('App\Category');
    }

    // RELATION WITH TAGS

    // posts-tags - categories
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}