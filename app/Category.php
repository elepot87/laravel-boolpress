<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //RELATION WITH POST 

    // categories - posts

    public function posts() {
        return $this->hasMany('App\Post');
    }
}
