<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //RELATION WITH POSTS

    //tags-posts

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}