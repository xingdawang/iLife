<?php

namespace App\Http\Controllers;

use App\Favorite_article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class FavoriteArticlesController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loader = $this->loadCategory();
        return view('favorite_articles.index', $loader);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check whether the article has already been liked
        if(Favorite_article::where('user_id', '=', Auth::user()->id)
                ->where('article_id', '=', $request->article_id)->count() < 1) {
            $favorite_artile = new Favorite_article();
            $favorite_artile->article_id = $request->article_id;
            $favorite_artile->user_id = Auth::user()->id;
            $favorite_artile->save();
            \Session::flash('flash_message', 'Favorite article add succeed!');
            return redirect()->route('articles.show',[$request->article_id]);
        } else{
            return redirect()->route('articles.show',[$request->article_id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_favorite_article = Favorite_article::where('article_id', '=', $id)
        ->where('user_id', '=', Auth::user()->id);
        $deleted_favorite_article->delete();

        \Session::flash('flash_message', 'Favorite article delete succeed!');
        return redirect('favorite_articles');

    }

    public function loadCategory(){
        $categories = Category::all();
        $favorites_list = DB::table('favorite_articles')
            ->join('articles', 'articles.id', '=', 'favorite_articles.article_id')
            ->where('favorite_articles.user_id', '=', Auth::user()->id)
            ->select('favorite_articles.*', 'articles.title')
            ->get();
        // link the category id and the its related articles
        $articlesNumber = [];
        foreach($categories as $category){
            if(CategoriesController::getArticleNumber($category->id) != null)
                $articlesNumber[$category->id] = CategoriesController::getArticleNumber($category->id)[0]->article_number;
            else
                $articlesNumber[$category->id] = '0';
        }
        $is_manager = User::getCurrentUser()->is_manager;
        return compact('categories', 'favorites_list','articlesNumber', 'is_manager');
    }
}
