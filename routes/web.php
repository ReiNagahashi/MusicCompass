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


Auth::routes();

Route::resource('posts','PostsController');

Route::get('/home', 'HomeController@index');


Route::get('/about',[
    'uses' => 'HomeController@show',
    'as'  => 'home.about'
]);



// ここからUsersController

Route::group(['middleware'=>'auth'],function(){

    Route::get('/myPosts',[
        'uses' => 'PostsController@myPost',
        'as'  => 'posts.myPosts'
    ]);
    Route::get('/posts/{post}',[
        'uses' => 'PostsController@show',
        'as'  => 'posts.show'
    ]);

    
    Route::get('/edit/{post}',[
        'uses' => 'PostsController@edit',
        'as'  => 'posts.edit'
    ]);

    Route::get('/posts/create',[
        'uses' => 'PostsController@create',
        'as'  => 'posts.create'
    ]);
    
    

    Route::get('/attendees/{post}',[
        'uses' => 'PostsController@single',
        'as'  => 'attendees.single'
    ]);

    Route::post('/attend/{post}',[
        'uses' => 'PostsController@attend',
        'as'  => 'posts.attend'
    ]);

    Route::delete('/cancel/{post}','PostsController@cancel');

    
    Route::get('/profile',[
        'uses' => 'ProfileController@index',
        'as'  => 'profile.index'
    ]);

    Route::get('/profile/{user}',[
        'uses' => 'ProfileController@show',
        'as'  => 'profile.show'
    ]);
    
    Route::get('/setting-profile',[
        'uses' => 'ProfileController@setting',
        'as'  => 'profile.setting'
    ]);
    
    Route::put('/profile/setting',[
        'uses' => 'ProfileController@updateForSetting',
        'as'  => 'profile.update2'
    ]);
    
    

    Route::get('/users','UsersController@index');
    Route::post('/follow/{user}','UsersController@follow');
    Route::delete('/unfollow/{user}','UsersController@unfollow');

    
    Route::get('/users/followList/{user}',[
        'uses' => 'UsersController@showFollow',
        'as'  => 'profile.showFollow'
    ]);

});


Route::post('/commentStore',[
    'uses' => 'CommentController@store',
    'as'  => 'comments.store'
]);

// ここからsocialiteのルーティング2つ

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');


Route::put('/profile/update',[
    'uses' => 'ProfileController@update',
    'as'  => 'profile.update'
]);

Route::get('/edit-profile',[
    'uses' => 'ProfileController@edit',
    'as'  => 'profile.edit'
]);

Route::get('/create-profile',[
    'uses' => 'ProfileController@create',
    'as'  => 'profile.create'
]);

Route::post('/profile-store',[
    'uses' => 'ProfileController@store',
    'as'  => 'profile.store'
]);


