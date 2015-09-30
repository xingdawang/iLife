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
        'mobile_articles_get_article',
        'mobile_articles_show_article',
        'mobile_get_category_list', //iLife iOS Backend API No.9
    ];
}
