<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Article;
use App\Image as HomeImage;
use Mail;

class FooterController extends Controller
{
    public function showPrivacy(){
        $categories = Category::all();
        $articles = Article::all();
        $articlesNumber = CategoriesController::getCategoryArticle();
        // if there is no article, set the article number to 0
        $articlesNumber[sizeof($articlesNumber) + 1] = "0";
        $images = HomeImage::all();
        $content = 'footer.privacy_content';
        return view('/footer/footer', compact('categories', 'articles', 'articlesNumber', 'images', 'content'));
    }

    public function aboutUs(){
        $categories = Category::all();
        $articles = Article::all();
        $articlesNumber = CategoriesController::getCategoryArticle();
        // if there is no article, set the article number to 0
        $articlesNumber[sizeof($articlesNumber) + 1] = "0";
        $images = HomeImage::all();
        $content = 'footer.about_us';
        return view('/footer/footer', compact('categories', 'articles', 'articlesNumber', 'images', 'content'));
    }

    public function feedback(){
        $categories = Category::all();
        $articles = Article::all();
        $articlesNumber = CategoriesController::getCategoryArticle();
        // if there is no article, set the article number to 0
        $articlesNumber[sizeof($articlesNumber) + 1] = "0";
        $images = HomeImage::all();
        $content = 'footer.feedback';
        return view('/footer/footer', compact('categories', 'articles', 'articlesNumber', 'images', 'content'));
    }

    public function feedback_email(Request $request){

        $categories = Category::all();
        $articlesNumber = CategoriesController::getCategoryArticle();
        // if there is no article, set the article number to 0
        $articlesNumber[sizeof($articlesNumber) + 1] = "0";
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
            compact('categories', 'articlesNumber', 'feedback_title', 'feedback_body'));
    }
}
