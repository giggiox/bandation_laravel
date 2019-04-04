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

Route::get('/', 'HomeController@homePageLoad')->name('/');
/*
Route::get('user/login',function(){
    return view('user/login');
})->name('user/login');*/


Route::get('user/register',function(){
    return view('welcome');

})->name('user/register');

/*
Route::get('user/{id}',function(){
    return view('user/user');
})->name('user');*/


/*Route::get('group/{id}',function(){
    return view('group/group');
})->name('group/group');*/



Route::prefix('event')->group(function(){
    Route::post('register','Event\RegisterController@register')->name('event/register');
});


Route::prefix('group')->group(function(){
    Route::get('{id}','Group\GroupController@show')->name('group');
    Route::post('addImageGroup','Group\GroupController@addImage')->name('addImageGroup');
    Route::post('subscribe','Group\GroupSubsciberController@subscribe')->name('subscribe');
    Route::post('addUserGroup','Group\GroupSubsciberController@addUser')->name('addUserGroup');
    Route::post('denyUserGroup','Group\GroupSubsciberController@denyUser')->name('denyUserGroup');
    Route::post('deleteImageGroup','Group\GroupController@deleteImage')->name('deleteImageGroup');
    Route::post('register','Group\RegisterController@register')->name('group/register');
    Route::post('update','Group\UpdateController@update')->name('group/update');
});


//Route::post('user/login','User\LoginController@login')->name('login');
//Route::get('user/logout','User\LoginController@logout')->name('user/logout');

Route::prefix('user')->group(function(){
    //se la route è 'user/' e basta ti rimanda alla tua pagina di user, senno al login. ->su chrome da dei problemi di cache in auth::user()
    Route::get('/',function(){
       if(\Auth::user())
           return redirect()->route('user',\Auth::user()->id);
       else
           return redirect()->route('user/login');
    });

    Route::get('login',function(){
        if(\Auth::user())
            return redirect()->back();
        else
            return view('user.login');
    })->name('user/login');
    Route::post('login','User\LoginController@login');
    Route::get('logout','User\LoginController@logout')->name('user/logout');
    Route::get('register',function(){
        return view('user.register');
    })->name('user/register');


    Route::post('register','User\RegisterController@register')->name('user/register');

    Route::post('update','User\UpdateController@update')->name('user/update');
    Route::get('{id}','User\UserController@show')->name('user');
    Route::post('addImageUser','User\UserController@addImage')->name('addImageUser');
    Route::post('deleteImageUser','User\UserController@deleteImage')->name('deleteImageUser');

    Route::get('verifyRegistration/{email}/{token}','User\RegisterController@verifyRegistration')->name('verifyRegistration');
});
