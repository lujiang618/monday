<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Routing\Router;
use \App\Supports\StringHelper;

Route::get('/', function () {
    return view('welcome');
});


/**
Route::group([
    'namespace'=> 'External',
    'prefix'=>'',
],function (Router $router){
    $router->post("/captcha", "CaptchaController@getCaptcha")->name("captcha");
});
 */


if (env('APP_ENV') === 'local') {
    // for testing, not in use
    Route::get('/i', function () {
        phpinfo();
    });


    Route::get('/test', function () {
        echo StringHelper::uuid();
    });
}