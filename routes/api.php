<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/facilities', function(Request $request){
    $room = \App\Room::where('id', $request->id)->select('ac', 'proyektor', 'listrik')->first();
    return $room;    
});

Route::post('/ip/update', 'APIController@IPUpdate');
Route::post('/usage', 'APIController@usage');