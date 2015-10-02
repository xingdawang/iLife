<?php

namespace App\Http\Controllers;

use App\Article;
use App\Favorite_article;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MobileArticlesController extends Controller
{

    public function test(){

        return view('mobile/test');
    }

    /**
     * iLife iOS Backend API No.1
     * @param Request $request
     * @return string
     */
    public function userSignIn(Request $request)
    {
        //Flag user state
        $flag = 0;
        $user = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        if ($user)
            $flag = 1;  //email and password matched, succeed
        else
            $flag = 2;  //Cannot signin, password is wrong

        // Check whether this user exist
        $user = User::where('email', '=', $request->email)->get();
        if(sizeof($user) == 0)
            $flag = 3;  //Cannot signin, user not exist

        switch($flag){
            case($flag == 1):
                $result = Array(
                    'code'      => 1000,
                    'message'   => 'Signin succeed',
                    'data'      => $user[0]->id
                );
                break;
            case($flag == 2):
                $result = Array(
                    'code'      => 2,
                    'message'   => 'Cannot signin, password is wrong',
                    'data'      => null
                );
                break;
            case($flag == 3):
                $result = Array(
                    'code'      => 1,
                    'message'   => 'Cannot signin, user not exist',
                    'data'      => null
                );
                break;
        }
        return json_encode($result);
    }

    /**
     * iLife iOS Backend API No.2
     * @param Request $request
     * @return string
     */
    public function userSignUp(Request $request){
        // Check whether this user exist
        $user = User::where('email', '=', $request->email)->get();
        if(sizeof($user) == 1){
            $result = Array(
                'code'      => 3,
                'message'   => 'Cannot signup, email has been registered',
                'data'      => null
            );
            return json_encode($result);
        }

        // If user does not exists, register a new user
        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = bcrypt($request->password);
        $new_user->save();

        // Send user an email after successfully registration
        $user_data['name']  = $request->name;
        $data['email'] = $request->email;
        Mail::send('email_reply/register_reply', $user_data, function($message) use ($data)
        {
            $message->from('no-reply@ilife.ie', "iLife");
            $message->subject("Welcome to iLife");
            $message->to($data['email']);
        });

        $result = Array(
            'code'      => 1000,
            'message'   => 'Sign up succeed',
            'data'      => $new_user->id
        );
        return json_encode($result);
    }

    /**
     * iLife iOS Backend API No.3
     * @param Request $request
     * @return string
     */
    public function userProfile(Request $request){
        // Check whether this user exist
        $user = User::find($request->id);
        if(sizeof($user) == 0){
            $result = Array(
                'code'      => 5,
                'message'   => 'User id is not found',
                'data'      => null
            );
            return json_encode($result);
        }else {
            $user_profile = Array(
                'name'          => $user->name,
                'is_manager'    => $user->is_manager
            );
        }
        $result = Array(
            'code'      => 1000,
            'message'   => 'Get user details succeed',
            'data'      => $user_profile
        );
        return json_encode($result);
    }

    /**
     * iLife iOS Backend API No.4
     * @return string
     */
    public function getArticleList(){

        $articles = DB::table('articles')
            ->select('articles.id as article_id', 'articles.title','articles.is_top',
                'images.image_url', 'articles.created_at', 'articles.updated_at')
            ->join('images', 'images.article_id', '=', 'articles.id')
            ->whereRaw('images.id = 3 * articles.id')
            ->get();
        return json_encode($articles);
    }

    /**
     * iLife iOS Backend API No.5
     * @param Request $request
     * @return string
     */
    public function articleDetails(Request $request){

        $article = Article::find($request->article_id);
        if(is_null($article)){
            $result = Array(
                'code'      => 5,
                'message'   => 'Article detail is not found',
                'data'      => null
            );
            return json_encode($result);
        } else {
            //find image title and body image
            $article_image = DB::table('images')
                ->where('article_id', $request->article_id)
                ->get();
            $article_title_image = $article_image[0]->image_url;
            $article_body_image = $article_image[1]->image_url;
            $article_details = Array(
                'user_id'       => $article->user_id,
                'title'         => $article->title,
                'title_image'   => $article_title_image,
                'body_image'    => $article_body_image,
                'article_body'  => $article->body,
                'created_at'    => $article->created_at,
                'updated_at'    => $article->updated_at
            );
            $result = Array(
                'code'      => 1000,
                'message'   => 'Get article details succeed',
                'data'      => $article_details
            );
            return json_encode($result);
        }
    }

    /**
     * iLife iOS Backend API No.6
     * @param Request $request
     * @return string
     */
    public function commentArticle(Request $request){

        $article = Article::find($request->article_id);
        $user = User::find($request->user_id);
        if(is_null($article)){ //Check whether article exists
            $result = Array(
                'code'      => 6,
                'message'   => 'article is not found',
                'data'      => null
            );
        } elseif(is_null($user)){ // Check user exists
            $result = Array(
                'code'      => 7,
                'message'   => 'user id is not found',
                'data'      => null
            );
        } else{
            $comment = new Comment();
            $comment->body = $request->comment_body;
            $comment->user_id = $request->user_id;
            $comment->article_id = $request->article_id;
            $comment->save();
            $result = Array(
                'code'      => 1000,
                'message'   => 'Post comment succeed',
                'data'      => null
            );
        }
        return json_encode($result);
    }

    /**
     * iLife iOS Backend API No.7
     * @param Request $request
     * @return string
     */
    public function getArticleComments(Request $request){
        $article = Article::find($request->article_id);
        if(is_null($article)){ //Check whether article exists
            $result = Array(
                'code'      => 8,
                'message'   => 'article is not found',
                'data'      => null
            );
        } else{
            $comments = Comment::where('article_id', $request->article_id)->get();
            foreach($comments as $comment){
                $each_comment[] = Array(
                    'user_id'       => $comment->user_id,
                    'comment_body'  => $comment->body,
                    'created_at'    => $comment->created_at
                );
            }
            $result = Array(
                'code'      => 1000,
                'message'   => 'Get comment succeed',
                'data'      => $each_comment
            );
        }
        return json_encode($result);
    }

    /**
     * iLife iOS Backend API No.8
     * @param Request $request
     * @return string
     */
    public function getFavoriteArticle(Request $request){
        $favorite_articles = Favorite_article::where('user_id', $request->user_id)->get();
        foreach($favorite_articles as $favorite_article){
            $favorite_article_list[] = Array(
                'article_id' => $favorite_article->id
            );
        }
        $result = Array(
            'code'      => 1000,
            'message'   => 'Get favorite succeed',
            'data'      => $favorite_article_list
        );
        return json_encode($result);
    }

    /**
     * iLife iOS Backend API No.9
     * @param Request $request
     * @return string
     */
    public function addFavoriteArticle(Request $request){
        $article = Article::find($request->article_id);
        $user = User::find($request->user_id);
        if(is_null($article)){ //Check whether article exists
            $result = Array(
                'code'      => 11,
                'message'   => 'article is not found',
                'data'      => null
            );
        } elseif(is_null($user)){ // Check user exists
            $result = Array(
                'code'      => 10,
                'message'   => 'user id is not found',
                'data'      => null
            );
        } else{
            Favorite_article::create($request->all());
            $result = Array(
                'code'      => 1000,
                'message'   => 'Add favorite succeed',
                'data'      => null
            );
        }
        return json_encode($result);
    }

    /**
     * iLife iOS Backend API No.10
     * @param Request $request
     * @return string
     */
    public function deleteFavoriteArticle(Request $request){
        $article = Favorite_article::where('article_id', $request->article_id)
            ->where('user_id', $request->user_id)->get();
        $user = User::find($request->user_id);
        if(is_null($article)){ //Check whether article exists
            $result = Array(
                'code'      => 12,
                'message'   => 'user favorite is not found',
                'data'      => null
            );
            dd($result);
        } elseif(is_null($user)){ // Check user exists
            $result = Array(
                'code'      => 13,
                'message'   => 'user id is not found',
                'data'      => null
            );
        } else{
            Favorite_article::where('article_id', $request->article_id)
                ->where('user_id', $request->user_id)->delete();
            $result = Array(
                'code'      => 1000,
                'message'   => 'Delete favorite succeed',
                'data'      => null
            );
        }
        return json_encode($result);
    }

    /**
     * iLife iOS Backend API No.11
     */
    public function getCategoryList() {
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
        return json_encode($result);
    }

    /**
     * iLife iOS Backend API No.12
     * @param Request $request
     * @return string
     */
    public function getCategoryArticles(Request $request){
        $category = Category::find($request->category_id);
        if(is_null($category)){
            $result = Array(
                'code'      => 14,
                'message'   => 'category_id is not found',
                'data'      => null
            );
        } else {
            $category_articles = Article::where('category_id', $request->category_id)->get();
            foreach($category_articles as $category_article){
                $article[] = Array(
                    'article_id' => $category_article->id
                );
            }
            $result = Array(
                'code'      => 1000,
                'message'   => 'get category details succeed',
                'data'      => $article
            );
        }
        return json_encode($result);
    }

    /**
     * iLife iOS Backend API No.13
     * @param Request $request
     * @return string
     */
    public function getStartPage(Request $request){
        if( $request->launch_id != '4_4s_640x960' &&
            $request->launch_id != '5_5s_640x1136' &&
            $request->launch_id != '6_6s_640x1334' &&
            $request->launch_id != '6p_6sp_1242x2208'
        ) {
            $result = Array(
                'code'      => 15,
                'message'   => 'Launch_id is not found',
                'data'      => null
            );
        } else {
            $data = Array(
                'text'  => 'This is the initial page!',
                'url'   => 'images/mobile/'.$request->launch_id.'.jpg'
            );
            $result = Array(
                'code'      => 1000,
                'message'   => 'Get launch image succeed',
                'data'      => $data
            );
        }
        return json_encode($result);
    }
}
