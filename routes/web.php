<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/{slug?}', function ($slug = 'home') {
    $storyblok = new \Storyblok\Client(
        apiKey: config('storyblok.api_key'),
        apiRegion: 'us'
    );
    $storyblok->editMode(); // always enable draft mode
    $data = $storyblok->getStoryBySlug($slug)->getBody();

    return view('index', ['story' => (object) $data['story']]);
});
Route::post('/_storyblok/', function (Request $request) {
    $story = $request->story;

    return view('components/page')->with('blok', $story['content']);
})->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/welcome', function () {
    return view('welcome');
});
