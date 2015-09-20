<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Image as HomeImage;
use DB;
use Input;
use Validator;
use Session;
use Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    /**
     *
     */
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
        $categories = Category::all();
        $articles = Article::all();

        return view('articles.index', compact('categories', 'articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $category_list = Category::lists('name', 'id');
        return view('articles.create', compact('categories', 'category_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_article = new Article;
        $new_article->user_id = auth()->user()->id;
        $new_article->category_id = $request->select;
        $new_article->title = $request->title;
        $new_article->body = $request->body;
        $new_article->save();

        //dd($new_article->id);
        if(Input::file('image') != null)
            $this->uploadImage('image', $new_article->id, 'body_img');

        //
        $categories = Category::all();
        $articles = Article::all();
        return view('articles.index', compact('categories', 'articles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        $comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('article_id', '=', $id)
            ->orderBy('comments.created_at', 'desc')
            ->select('comments.*', 'users.name')
            ->get();
        //dd($comments);
        return view('articles.show', compact('categories','article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $category_list = Category::lists('name', 'id');
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('categories', 'category_list', 'article'));
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
        //dd("in update method");
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return redirect('articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect('articles');
    }

    /**
     * @param $image_name
     * @param $article_id
     * @param $image_type
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function uploadImage($image_name, $article_id, $image_type){

        // getting all of the post data
        $file = array('image' => Input::file($image_name));
        // setting up rules
        // Apache default upload_max_filesize = 2M (etc/php5/php.ini)
        $rules = array('image' => 'image'); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return redirect('articles/create')->withInput()->withErrors($validator);
        }
        else {
            // checking file is valid.
            if (Input::file($image_name)->isValid()) {
                $extension = Input::file($image_name)->getClientOriginalExtension(); // getting image extension
                $fileName = $article_id.$image_type.'.'.$extension; // rename image

                /**
                 * Image Manipulation using intervention image
                 */
                $img = Image::make(Input::file($image_name));
                $img->resize(1066, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->crop(1000, 300, 0, 0);
                $img->save(base_path().'/public/images/articles/'.$fileName);// uploading file to given path

                /**
                 * Save article id and image url into the database
                 */
                $image_db = new HomeImage();
                $image_db->article_id = $article_id;
                $image_db->image_url = base_path().'/public/images/articles/'.$fileName;
                $image_db->save();


                // sending back with message
                Session::flash('success', 'Upload successfully');
                return redirect('articles/create');
            }
            else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return redirect('articles/create');
            }
        }
    }
}
