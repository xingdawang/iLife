<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Category;
use App\Http\Requests\CategoriesFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Image as HomeImage;

class CategoriesController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('manager', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loader = $this->loadCategory();
        return view('categories.index', $loader);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CategoriesFormRequest $request
     * @return \Illuminate\View\View
     */
    public function store(CategoriesFormRequest $request)
    {
        //dd($request);
        Category::create($request->all());
        $loader = $this->loadCategory();
        return view('categories.index', $loader);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loader = $this->loadCategoryWithId($id);
        return view('categories.show', $loader);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $articlesNumber = $this->getCategoryArticle();
        return view('categories.edit', compact('category', 'articlesNumber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoriesFormRequest $request
     * @param $id
     * @return \Illuminate\View\View
     */
    public function update(CategoriesFormRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('categories');
    }

    /**
     * Get a specific type of category's articles
     * @return array
     */
    public static function getCategoryArticle(){
        // get categories' articles
        $article_numbers = DB::table('categories')
            ->join('articles', 'categories.id', '=', 'articles.category_id')
            ->groupBy('articles.category_id')
            ->select('categories.id', DB::raw('COUNT(categories.id) as article_number'))
            ->get();

        // save the articles number in the array
        $articles = [];
        foreach($article_numbers as $article)
            $articles[$article->id] = $article->article_number;
        return $articles;
    }

    /**
     * Get Article numbers
     * @param $id
     * @return mixed
     */
    public static function getArticleNumber($id){
        // get categories' articles
        $article_number = DB::table('categories')
            ->join('articles', 'categories.id', '=', 'articles.category_id')
            ->groupBy('articles.category_id')
            ->select('categories.id', DB::raw('COUNT(categories.id) as article_number'))
            ->where('categories.id', '=', $id)
            ->get();
        return $article_number;
    }

    /**
     * load Category information
     * @return array
     */
    public function loadCategory(){
        $categories = Category::all();
        // link the category id and the its related articles
        $articlesNumber = [];
        foreach($categories as $category){
            if($this->getArticleNumber($category->id) != null)
                $articlesNumber[$category->id] = $this->getArticleNumber($category->id)[0]->article_number;
            else
                $articlesNumber[$category->id] = '0';
        }
        if(User::getCurrentUser() != null)
            $is_manager = User::getCurrentUser()->is_manager;
        else
            $is_manager = false;
        return compact('categories', 'articlesNumber', 'is_manager');
    }

    /**
     * @param $id
     * @return array
     */
    public function loadCategoryWithId($id){
        $categories = Category::all();
        $category = Category::findOrFail($id);
        $articles = Article::where('category_id', '=', $category->id)->get();
//        dd($articles);
        $top_list_articles = DB::table('articles')
            ->join('images', 'images.article_id', '=', 'articles.id')
            ->where('image_url', 'like', '%title_icon%')
            ->where('articles.is_top', '=', 2)
            ->get();
//        dd($top_list_articles);
        // if there is no article, set the article number to 0
        $articlesNumber = [];
        foreach($categories as $category){
            if($this->getArticleNumber($category->id) != null)
                $articlesNumber[$category->id] = $this->getArticleNumber($category->id)[0]->article_number;
            else
                $articlesNumber[$category->id] = '0';
        }

        $images = DB::table('images')
            ->join('articles', 'images.article_id', '=', 'articles.id')
            ->where('articles.category_id', '=', $id)
            ->where('image_url', 'like', '%title_icon%')
            ->get();
//        dd($images);
        if(User::getCurrentUser() != null)
            $is_manager = User::getCurrentUser()->is_manager;
        else
            $is_manager = false;
        return compact('categories', 'category', 'articles', 'top_list_articles', 'articlesNumber','images', 'is_manager');
    }
}
