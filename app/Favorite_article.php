<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite_article extends Model
{
    public function favorite_article(){
        return $this->belongsTo('App\User');
    }
}
