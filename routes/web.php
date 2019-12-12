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

Route::get('/', function () {
    return view('welcome');
});

//$router->post('login', ['uses' => 'loginController@login']);
$router->get('showlogin', ['uses' => 'loginController@showlogin']);

$router->get('viewmsg', ['uses' => 'TestController@viewmsg']);
$router->get('showallmsg', ['uses' => 'TestController@showallmsg']);
$router->get('logout', ['uses' => 'TestController@logout']);
$router->post('updat', ['uses' => 'TestController@updat']);
$router->post('newmsg', ['uses' => 'TestController@newmsg']);
$router->post('deletemsg', ['uses' => 'TestController@deletemsg']);
$router->put('updatemsg', ['uses' => 'TestController@updatemsg']);


Route::get('profile', function () {
    // Only verified users may enter...

})->middleware('verified');

//email測試用
Route::get('/warning', 'WarningController@send');

Auth::routes(['verify' => true]);
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
