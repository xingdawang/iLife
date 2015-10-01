<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'mobile_user_sign_in',          //iLife iOS Backend API No.1
        'mobile_user_sign_up',          //iLife iOS Backend API No.2
        'mobile_user_profile',          //iLife iOS Backend API No.3
        'mobile_get_article_list',      //iLife iOS Backend API No.4
        'mobile_article_details',       //iLife iOS Backend API No.5
        'mobile_get_category_list',     //iLife iOS Backend API No.9
        'mobile_get_start_page',        //iLife iOS Backend API No.13
    ];
}
