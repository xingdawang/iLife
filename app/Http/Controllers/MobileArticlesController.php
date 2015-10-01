<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
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
    public function ArticleDetails(Request $request){

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
     * iLife iOS Backend API No.9
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

    public function getStartPage(){
        $result = Array(
            'text'  => 'This is the initial page!',
            'url'   => 'images/mobile/start_page.jpg'
        );
        return $result;
        return json_encode($result);
    }
}
