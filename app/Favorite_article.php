<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite_article extends Model
{
    protected $fillable = ['article_id', 'user_id'];

    public function favorite_article(){
        return $this->belongsTo('App\User');
    }
}
