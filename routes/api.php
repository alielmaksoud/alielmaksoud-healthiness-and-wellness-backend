<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// blogs
Route::get('/item', 'GetItemController@index');
Route::get('/item/{id}', 'GetItemController@show');

//  categories
Route::get('category', 'GetCategoryController@index');
Route::get('category/{id}', 'GetCategoryController@show');

//  genders
Route::get('gender', 'GetGenderController@index');
Route::get('gender/{id}', 'GetGenderController@show');

//  status
Route::get('status', 'GetStatusController@index');
Route::get('status/{id}', 'GetStatusController@show');

//  activity
Route::get('activity', 'GetActivityController@index');
Route::get('activity/{id}', 'GetActivityController@show');

// messages 
Route::post('message', 'MessageController@store');

// testimonial
Route::get('/testimonial', 'TestimonialController@index');


// admin 
Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admin']],function ()
{
    
    Route::post('login', 'AdminController@login');

    
});

Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admin','jwt.auth']],function ()

{
    
    //  admin
    Route::post('logout', 'AdminController@logout');
    Route::post('refresh', 'AdminController@refresh');
    Route::get('profile', 'AdminController@profile');
    Route::post('/verify','AdminController@verifytokens');
    Route::delete('/{id}', 'AdminController@destroy');
    Route::put('/{id}', 'AdminController@update');
    Route::get('/show', 'AdminController@index');
    Route::post('register', 'AdminController@register');

    // user
    Route::get('/user/show', 'AdminController@indexuser');
    Route::delete('/user/{id}', 'AdminController@destroyuser');
    Route::put('/user/{id}', 'AdminController@updateuser');   


    //  category
    Route::post('category', 'CategoryController@store');
    Route::put('/category/{id}', 'CategoryController@update');
    Route::delete('/category/{id}', 'CategoryController@destroy');

   // blog
    // Route::get('/item', 'ItemController@index'); 
    Route::post('/item', 'ItemController@store');
    Route::put('/item/{id}', 'ItemController@update');
    Route::delete('/item/{id}', 'ItemController@destroy');

   // message
   Route::get('message', 'MessageController@index');
   Route::delete('message/{id}', 'MessageController@destroy');
   Route::get('message/{id}', 'MessageController@show');

    // testimonial
    Route::post('/testimonial', 'TestimonialController@store');
    Route::delete('/testimonial/{id}', 'TestimonialController@destroy');
    Route::put('testimonial/{id}', 'TestimonialController@update');
    Route::get('/testimonial', 'TestimonialController@index');

});


///////// user


Route::group(['prefix' => 'user','middleware' => ['assign.guard:api']],function ()
{
    Route::post('register', 'JWTAuthController@register');
    Route::post('login', 'JWTAuthController@login');
});




Route::group(['prefix' => 'user','middleware' => ['assign.guard:api','jwt.auth']],function ()
{

    Route::post('logout', 'JWTAuthController@logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::get('profile', 'JWTAuthController@profile');
    Route::delete('/{id}', 'JWTAuthController@destroy');
    Route::put('/{id}', 'JWTAuthController@update');
    Route::post('/verify','JWTAuthController@verifytokens');

      ///////////////
      Route::get('/cart', 'CartController@index');
      Route::get('/cart/{id}', 'CartController@show');
      
      ///////////////
    Route::get('/cart', 'CartController@index');
    Route::get('/cart/{id}', 'CartController@show');
     
    ///////////////
    Route::get('/cartItem', 'CartItemController@index');
    Route::post('/cartItem', 'CartItemController@store');
    Route::get('/cartItem/{id}', 'CartItemController@show');
    Route::put('/cartItem/{id}', 'CartItemController@update');
    Route::delete('/cartItem/{id}', 'CartItemController@destroy');
    Route::delete('/cartitems/delete', 'CartItemController@delete');


});



