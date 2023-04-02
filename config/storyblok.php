<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Storyblok configuration
    |--------------------------------------------------------------------------
    | In the .env file you have to set:
    |
    | STORYBLOK_API_KEY=youraccesstoken
    | STORYBLOK_DRAFT=false
    |
    | For retrieving the access token:
    | https://www.storyblok.com/tp/add-a-headless-cms-to-laravel-in-5-minutes#connecting-laravel-to-storyblok
    |
    */

    'api_key' => env('STORYBLOK_API_KEY'),
    'draft' => env('STORYBLOK_DRAFT', false),
];
