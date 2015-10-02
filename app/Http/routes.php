<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','CategoriesController@index');
Route::controllers([
    'auth'      => 'Auth\AuthController',
    'password'  => 'Auth\PasswordController'
]);
Route::resource('categories', 'CategoriesController');
Route::resource('articles', 'ArticlesController');
Route::resource('comments', 'CommentsController');
Route::resource('favorite_articles', 'FavoriteArticlesController');
Route::resource('article_images', 'ImagesController');
Route::get('privacy','FooterController@showPrivacy');
Route::get('about_us','FooterController@aboutUs');
Route::get('feedback', 'FooterController@feedback');
Route::post('feedback_email',['as'=>'feedback_email', 'uses' => 'FooterController@feedback_email']);

/**
 * These below routes are for mobiles
 */
Route::post('mobile_user_sign_in',                                  //No.1
    ['as' => 'mobile_user_sign_in',
        'uses' => 'MobileArticlesController@userSignIn']);
Route::post('mobile_user_sign_up',                                  //No.2
    ['as' => 'mobile_user_sign_up',
        'uses' => 'MobileArticlesController@userSignUp']);
Route::post('mobile_user_profile',                                  //No.3
    ['as' => 'mobile_user_profile',
        'uses' => 'MobileArticlesController@userProfile']);
Route::get('mobile_get_article_list',                               //No.4
    ['as' => 'mobile_get_article_list',
        'uses' => 'MobileArticlesController@getArticleList']);
Route::post('mobile_article_details',                               //No.5
    ['as' => 'mobile_article_details',
        'uses' => 'MobileArticlesController@articleDetails']);
Route::post('mobile_comment_article',                               //No.6
    ['as' => 'mobile_comment_article',
        'uses' => 'MobileArticlesController@commentArticle']);
Route::post('mobile_get_article_comments',                          //No.7
    ['as' => 'mobile_get_article_comments',
        'uses' => 'MobileArticlesController@getArticleComments']);
Route::post('mobile_get_favorite_articles',                         //No.8
    ['as' => 'mobile_get_favorite_articles',
        'uses' => 'MobileArticlesController@getFavoriteArticle']);
Route::post('mobile_add_favorite_articles',                         //No.9
    ['as' => 'mobile_add_favorite_articles',
        'uses' => 'MobileArticlesController@addFavoriteArticle']);
Route::post('mobile_delete_favorite_articles',                      //No.10
    ['as' => 'mobile_delete_favorite_articles',
        'uses' => 'MobileArticlesController@deleteFavoriteArticle']);
Route::get('mobile_get_category_list',                              //No.11
    ['as' => 'mobile_get_category_list',
        'uses' => 'MobileArticlesController@getCategoryList']);
Route::post('mobile_get_category_articles',                          //No.12
    ['as' => 'mobile_get_category_articles',
        'uses' => 'MobileArticlesController@getCategoryArticles']);
Route::post('mobile_get_start_page',                                 //No.13
    ['as' => 'mobile_get_start_page',
        'uses' => 'MobileArticlesController@getStartPage']);

/**
 * This below routes are for mobiles test
 */
//Route::get('test', 'MobileArticlesController@test');