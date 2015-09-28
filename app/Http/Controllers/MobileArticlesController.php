<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MobileArticlesController extends Controller
{
    public function getArticle(Request $request){
//        dd($request);
        die(json_encode(Array('id' => $request->id)));
    }

    public function showArticle(){

        return view('mobile/test');
    }
}
