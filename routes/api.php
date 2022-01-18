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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->namespace('App\Http\Controllers\Api')->group(function (){
    
    Route:: name('real_states.')->group(function(){
        
        Route::resource('real-states', 'RealStateController'); // api/v1/real-state/
    });

    Route:: name('users.')->group(function(){
        
        Route::resource('users', 'UserController'); // api/v1/users/
    });

    Route:: name('categories.')->group(function(){
        Route::get('/categories/{id}/real-states', 'CategoryController@realState');
        Route::resource('categories', 'CategoryController'); // api/v1/categories/
    });
});
