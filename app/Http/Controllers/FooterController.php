<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Article;
use App\Image as HomeImage;
use Mail;
use App\User;

class FooterController extends Controller
{
    public function showPrivacy(){
        $categories = Category::all();
        $articles = Article::all();
        // link the category id and the its related articles
        $articlesNumber = [];
        foreach($categories as $category){
            if(CategoriesController::getArticleNumber($category->id) != null)
                $articlesNumber[$category->id] = CategoriesController::getArticleNumber($category->id)[0]->article_number;
            else
                $articlesNumber[$category->id] = '0';
        }
        if(User::getCurrentUser() != null)
            $is_manager = User::getCurrentUser()->is_manager;
        else
            $is_manager = false;
        $content = 'footer.privacy_content';
        return view('/footer/footer', compact('categories', 'articles', 'articlesNumber', 'images', 'content', 'is_manager'));
    }

    public function aboutUs(){
        $categories = Category::all();
        $articles = Article::all();
        // link the category id and the its related articles
        $articlesNumber = [];
        foreach($categories as $category){
            if(CategoriesController::getArticleNumber($category->id) != null)
                $articlesNumber[$category->id] = CategoriesController::getArticleNumber($category->id)[0]->article_number;
            else
                $articlesNumber[$category->id] = '0';
        }
        $images = HomeImage::all();
        $content = 'footer.about_us';
        if(User::getCurrentUser() != null)
            $is_manager = User::getCurrentUser()->is_manager;
        else
            $is_manager = false;
        return view('/footer/footer', compact('categories', 'articles', 'articlesNumber', 'images', 'content', 'is_manager'));
    }

    public function feedback(){
        $categories = Category::all();
        $articles = Article::all();
        // link the category id and the its related articles
        $articlesNumber = [];
        foreach($categories as $category){
            if(CategoriesController::getArticleNumber($category->id) != null)
                $articlesNumber[$category->id] = CategoriesController::getArticleNumber($category->id)[0]->article_number;
            else
                $articlesNumber[$category->id] = '0';
        }
        $images = HomeImage::all();
        $content = 'footer.feedback';
        if(User::getCurrentUser() != null)
            $is_manager = User::getCurrentUser()->is_manager;
        else
            $is_manager = false;
        return view('/footer/footer', compact('categories', 'articles', 'articlesNumber', 'images', 'content', 'is_manager'));
    }

    public function feedback_email(Request $request){

        $categories = Category::all();
        // link the category id and the its related articles
        $articlesNumber = [];
        foreach($categories as $category){
            if(CategoriesController::getArticleNumber($category->id) != null)
                $articlesNumber[$category->id] = CategoriesController::getArticleNumber($category->id)[0]->article_number;
            else
                $articlesNumber[$category->id] = '0';
        }
        if(User::getCurrentUser() != null)
            $is_manager = User::getCurrentUser()->is_manager;
        else
            $is_manager = false;

        $feedback_title = $request->title;
        $feedback_body = $request->feedback;

        $data = [
            'categories'        => $categories,
            'articlesNumber'    => $articlesNumber,
            'feedback_title'    => $feedback_title,
            'feedback_body'     => $feedback_body
        ];
        Mail::send('footer.feedback_content', $data, function($message) {
            $message->to('feedback@ilife.ie', 'John Smith')->subject('Feedback!');
        });
        return view('/footer/feedback_review',
            compact('categories', 'articlesNumber', 'feedback_title', 'feedback_body', 'is_manager'));
    }
}
