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

//  ici je fais le test pour les differentes methodes de socket io scop
Route::get('fire', function () {
    // this fires the event
    event(new App\Events\Event());
    return "event fired";
});

Route::get('connect', function () {
    // this checks for the event
    return view('connect');
});







Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::resource('Publication', 'PublicationController')->names([
    'index' => 'publication'
])->middleware('auth');
Route::resource('document', 'DocumentController')->middleware('auth');
   Route::post('/comments/{publication}',"PublicationController@comments")->name('comments');
Route::get('/rapport',"PublicationController@rapport")->name("rapport")->middleware('auth');
Route::get('/commentaire/{id}',"PublicationController@commentaire")->name("commentaire")->middleware('auth');
Route::get('/messages',"PublicationController@messages")->name("messages")->middleware('auth');
Route::get('/discussion/{id}',"PublicationController@discussion")->name("discussion")->middleware('auth');
   Route::post('/api/postes',"Api@postes")->name('postes');
Route::prefix('/api')->middleware('auth')->group(function (){
   Route::post('/get_task',"Api@get_task")->name('get_task');
   Route::post('/update_task',"Api@update_task")->name('update_task');
   Route::post('/delete_task',"Api@delete_task")->name('delete_task');
   Route::post('/create_task',"Api@create_task")->name("create_task");
   Route::resource('publication', 'PublicationController');
   Route::post('/create_pub',"Api@create_pub")->name("create_pub");

   Route::post('/create_rapport',"Api@create_rapport")->name("create_rapport");
   Route::post('/update_rapport',"Api@update_rapport")->name("update_rapport");
   Route::post('/find_rapport',"Api@find_rapport")->name("find_rapport");

   Route::post('/get_user',"Api@get_user")->name("get_user");
   Route::post('/post_message/{id}/{id2}',"Api@post_message")->name("post_message");
    Route::post('/get_message/{id}/{id2}',"Api@get_message")->name("get_message");

     Route::post('/user',"Api@user")->name("user");
     Route::post('/get_last',"Api@get_last")->name("get_last");
     Route::post('/get_last1',"Api@get_last1")->name("get_last1");

    Route::post('/get_commentaire/{id}',"Api@get_commentaire")->name("get_commentaire");
    Route::post('/post_commentaire/{id}',"Api@post_commentaire")->name("post_commentaire");


    /*i je mets tout le code pour la partie du travail au nivau des messages*/
    Route::post('get_user_conversation',"ChatController@get_user_conversation")->name('get_user_conversation');
    Route::post('get_conversation',"ChatController@get_conversation")->name('get_conversation');
    Route::post('get_message_conversation',"ChatController@get_message_conversation")->name('get_message_conversation');
    Route::post('envoi_message',"ChatController@envoi_message")->name('envoi_message');
    Route::post('get_notification',"ChatController@get_notification")->name('get_notification');
    Route::post('get_notification',"ChatController@get_notification")->name('get_notification');

});
