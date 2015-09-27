<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Article;
use App\Category;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['only' => 'create']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_comment = new Comment();
        $new_comment->user_id = Auth::user()->id;
        $new_comment->article_id = $request->article_id;
        $new_comment->body = $request->body;
        $new_comment->save();
        return redirect()->route('articles.show',[$request->article_id]);
    }

    /**
     * Display the specified resource.
     * @param $article_id
     * @return mixed
     */
    public static function show($article_id)
    {
        $comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('article_id', '=', $article_id)
            ->orderBy('comments.created_at', 'desc')
            ->select('comments.*', 'users.name')
            ->get();
        return $comments;
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
    public function destroy(Request $request, $id)
    {
//        $article = Article::findOrFail($id);
//        $article->delete();
//        return redirect('articles');
//        dd($request);
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('articles.show',[$request->article_id]);
    }
}
