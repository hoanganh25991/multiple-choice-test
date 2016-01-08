<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('login', 'LoginController@get');
Route::post('login', 'LoginController@post');
Route::group(array('before'=>'auth'), function(){
    Route::get('/', function(){return Redirect::to('test');});
    Route::get('test', 'TestController@get');
    Route::post('test', 'TestController@post');
    Route::get('result', 'ResultController@get');
    Route::post('result', 'ResultController@post');
    //only for admin
    Route::group(array('prefix' => 'admin', 'before' => 'admin'), function(){
        Route::get('/', 'AdminController@get');
        Route::post('/', 'AdminController@post');

        Route::get('test-options', 'TestOptionsController@get');
        Route::get('chapter-rate', 'ChapterRateController@get');
        //bind model for chapters
        Route::model('chapter', 'Chapter');
        Route::get('chapters', 'ChaptersController@get');
        Route::get('chapters/{chapter}', 'ChaptersController@getQuestions');

        Route::post('test-options', 'TestOptionsController@post');
        Route::post('chapter-rate', 'ChapterRateController@post');
        Route::post('chapters', 'ChaptersController@post');
        Route::post('chapters/{chapter}', 'ChaptersController@postQuestionChange');

        Route::get('csv', 'CsvController@get');
        Route::post('csv', 'CsvController@post');
        //modify database: delete-all
//        Route::get('delete-all/contestant', function(){Contestant::truncate();});//below code is more general
        Route::get('delete-all/{model}', function($model){$model::truncate();});
    });
});
Route::get('log-out', 'LogOutController@get');
//general-route to test bootstrap-theme
Route::get('/{name}', function($name){
    return View::make($name);
});


