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

// home page
Route::get('/', 'PagesController@getIndex');
// for audio or mp3 files
Route::resource('audios',  'audiosController');
Route::post('/audios/postAjaxDelete', 'audiosController@ajaxDelete');
// for twilio infos
Route::resource('twilioCredentials',  'twilioCredentialsController');
// for call flooders
Route::get('/callFlooders/xmlCallResponse/{fileName}', 'CallFloodersController@xmlCallResponse');
Route::get('/callFlooders/call/{id}/{minutes?}', 'CallFloodersController@makeCallPage');
Route::post('/callFlooders/postAjaxDelete', 'CallFloodersController@ajaxDelete');
Route::post('/callFlooders/postAjaxTwilioCall', 'CallFloodersController@postAjaxTwilioCall');
Route::resource('callFlooders',  'CallFloodersController');
// for call schedules
Route::resource('schedules',  'schedulesController');
Route::post('/schedules/postAjaxDelete', 'schedulesController@ajaxDelete');

