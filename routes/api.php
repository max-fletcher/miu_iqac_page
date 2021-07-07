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
// Refactor Controller to use Restful Controllers later maybe

// About Content Type Controller
Route::get('/about/contenttype/index', [App\Http\Controllers\AboutContentTypeController::class, 'index']);
Route::post('/about/contenttype/store', [App\Http\Controllers\AboutContentTypeController::class, 'store']);
Route::get('/about/contenttype/show/{id}', [App\Http\Controllers\AboutContentTypeController::class, 'show']);
Route::patch('/about/contenttype/update/{id}', [App\Http\Controllers\AboutContentTypeController::class, 'update']);
Route::delete('/about/contenttype/delete/{id}', [App\Http\Controllers\AboutContentTypeController::class, 'destroy']);
Route::get('/about/contenttype/contenttypewithoutcontent', [App\Http\Controllers\AboutContentTypeController::class, 'content_type_without_content']);

// About Content Controller
Route::get('/about/content/index', [App\Http\Controllers\AboutContentController::class, 'index']);
Route::post('/about/content/store', [App\Http\Controllers\AboutContentController::class, 'store']);
Route::get('/about/content/show/{id}', [App\Http\Controllers\AboutContentController::class, 'show']);
Route::patch('/about/content/update/{id}', [App\Http\Controllers\AboutContentController::class, 'update']);
Route::delete('/about/content/delete/{id}', [App\Http\Controllers\AboutContentController::class, 'destroy']);
Route::get('/about/content/contentbytypeid/{id}', [App\Http\Controllers\AboutContentController::class, 'find_all_content_by_type_id']);

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
Route::get('/people/members/membersbypeopleid/{id}', [App\Http\Controllers\MemberController::class, 'find_all_members_by_people_id']);
