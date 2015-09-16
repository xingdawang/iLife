<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function manager(){
        return $this->belongsTo('App\Manager');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function favorite_article(){
        return $this->hasOne('App\Favorite_article');
    }

    public function article(){
        $this->belongsTo('App\Article');
    }
}
