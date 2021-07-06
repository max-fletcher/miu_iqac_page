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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/authenticated', function(Request $request){
        return true;
    });

});

Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register']);
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout']);


    // Back End
// People Controller
Route::get('/people/index', [App\Http\Controllers\PeopleController::class, 'index']);
Route::post('/people/store', [App\Http\Controllers\PeopleController::class, 'store']);
Route::get('/people/show/{id}', [App\Http\Controllers\PeopleController::class, 'show']);
Route::patch('/people/update/{id}', [App\Http\Controllers\PeopleController::class, 'update']);
Route::delete('/people/delete/{id}', [App\Http\Controllers\PeopleController::class, 'destroy']);

// Member Controller
Route::get('/people/members/index', [App\Http\Controllers\MemberController::class, 'index']);
Route::post('/people/members/store', [App\Http\Controllers\MemberController::class, 'store']);
Route::get('/people/members/show/{id}', [App\Http\Controllers\MemberController::class, 'show']);
Route::patch('/people/members/update/{id}', [App\Http\Controllers\MemberController::class, 'update']);
Route::delete('/people/members/delete/{id}', [App\Http\Controllers\MemberController::class, 'destroy']);
Route::get('/people/members/{id}', [App\Http\Controllers\MemberController::class, 'find_all_members_by_people_id']);
