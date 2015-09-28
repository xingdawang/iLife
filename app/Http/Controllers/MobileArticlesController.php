<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MobileArticlesController extends Controller
{
    public function getArticle($id){
        $id = 1;
        $article = Article::findOrFail($id);
        dd($article);
    }
}
