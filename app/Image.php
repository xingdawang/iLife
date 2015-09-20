<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'article_id',
        'image_url'
    ];

    public function article(){
        return $this->belongsTo('App\Article');
    }
}
