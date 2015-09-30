<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class MobileArticlesController extends Controller
{
    public function getArticle(Request $request){
//        dd($request);
        die(json_encode(Array('id' => $request->id)));
    }

    public function showArticle(){

        return view('mobile/test');
    }

    /**
     * iLife iOS Backend API No.9
     */
    public function getCategoryList()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $category_list[] = Array(
                'id'    => $category->id,
                'name'  => $category->name

            );
        }
        $result = Array(
            'code'      => 1000,
            'message'   => 'category get succeed',
            'data'      => $category_list
        );
        return ($result);
    }
}
