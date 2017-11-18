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

$admin = [
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'auth',
];

Route::group($admin, function () {

    Route::get('/', 'AccountController@Manage');

    // account
    Route::group(['prefix' => 'account',], function () {
        Route::get('/','AccountController@Index');
        Route::get('create','AccountController@Create');
        Route::post('create','AccountController@postCreate');
        Route::get('update/{id}','AccountController@update');
        Route::post('update/{id}','AccountController@postUpdate');
        Route::get('destroy/{id}','AccountController@Destroy');
        Route::get('change-account/{id}','AccountController@ChangeAccount');
    });

    Route::group(['middleware' => 'account'], function () {

        // menu
        Route::group(['prefix' => 'menu',], function () {
            Route::get('/','MenuController@Index');
            Route::get('create','MenuController@Create');
            Route::get('lists','MenuController@Lists');
            Route::post('store','MenuController@Store');
        });

        /*// user
        Route::group(['prefix' => 'user',], function () {
            Route::get('/','UserController@Index');
            Route::get('password','UserController@Password');
        });

        // message
        Route::group(['prefix' => 'message',], function () {
            Route::get('/','MessageController@Index');
            Route::get('timeline','MessageController@Timeline');
            Route::get('broadcasting','MessageController@Broadcasting');
            Route::get('resource','MessageController@Resource');
        });

        // fan
        Route::group(['prefix' => 'fan',], function () {
            Route::get('/','FanController@Index');
            Route::get('lists','FanController@Lists');
            Route::post('remark','FanController@Remark');
            Route::get('resource','FanController@Resource');
        });

        // fan-group
        Route::group(['prefix' => 'fan-group',], function () {
            Route::get('/','FanGroupController@Index');
            Route::get('lists','FanGroupController@Lists');
            Route::post('store','FanGroupController@Store');
            Route::post('update','FanGroupController@Update');
            Route::delete('destory','FanGroupController@Destory');
            Route::post('move-fans','FanGroupController@MoveFans');
        });

        // material
        Route::group(['prefix' => 'material',], function () {
            Route::get('/','MaterialController@Index');
            Route::get('lists','MaterialController@Lists');
            Route::get('show','MaterialController@Show');
            Route::get('summary','MaterialController@Summary');
            Route::get('new-article','MaterialController@NewArticle');
            Route::post('new-article','MaterialController@postNewArticle');
            Route::post('voice','MaterialController@postVoice');
            Route::post('video','MaterialController@postVideo');
        });

        // staff
        Route::group(['prefix' => 'staff',], function () {
            Route::get('/', 'StaffController@Index');
            Route::get('performance', 'StaffController@Performance');
        });

        // reply
        Route::group(['prefix' => 'reply',], function () {
            Route::get('/', 'ReplyController@Index');
            Route::get('follow-reply', 'ReplyController@FollowReply');
            Route::get('no-match-reply', 'ReplyController@NoMatchReply');
            Route::get('lists', 'ReplyController@Lists');
            Route::post('save-event-reply', 'ReplyController@postSaveEventReply');
            Route::post('store', 'ReplyController@postStore');
            Route::post('update', 'ReplyController@postUpdate');
        });

        // upload
        Route::group(['prefix' => 'upload',], function () {
            Route::post('/', 'UploadController@postIndex');
        });*/

    });
});
