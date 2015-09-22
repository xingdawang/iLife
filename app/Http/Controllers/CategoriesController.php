<?php

namespace App\Http\Controllers;

use App\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Category;
use App\Http\Requests\CategoriesFormRequest;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $articlesNumber = $this->getCategoryArticle();
        return view('categories.index', compact('categories', 'articlesNumber'));
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
        $categories = Category::all();
        $articlesNumber = $this->getCategoryArticle();
        return view('categories.index', compact('categories', 'articlesNumber'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        $articles = Article::where('category_id', '=', $category->id)->get();
        $articlesNumber = $this->getCategoryArticle();
        return view('categories.show', compact('categories', 'category', 'articles', 'articlesNumber'));
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
}
