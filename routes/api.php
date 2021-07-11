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
Route::delete('/about/contenttype/destroy/{id}', [App\Http\Controllers\AboutContentTypeController::class, 'destroy']);
Route::get('/about/contenttype/contenttypewithoutcontent', [App\Http\Controllers\AboutContentTypeController::class, 'content_type_without_content']);

// About Content Controller
Route::get('/about/content/index', [App\Http\Controllers\AboutContentController::class, 'index']);
Route::post('/about/content/store', [App\Http\Controllers\AboutContentController::class, 'store']);
Route::get('/about/content/show/{id}', [App\Http\Controllers\AboutContentController::class, 'show']);
Route::patch('/about/content/update/{id}', [App\Http\Controllers\AboutContentController::class, 'update']);
Route::delete('/about/content/destroy/{id}', [App\Http\Controllers\AboutContentController::class, 'destroy']);
Route::get('/about/content/contentbytypeid/{id}', [App\Http\Controllers\AboutContentController::class, 'find_all_content_by_type_id']);

// People Controller
Route::get('/people/index', [App\Http\Controllers\PeopleController::class, 'index']);
Route::post('/people/store', [App\Http\Controllers\PeopleController::class, 'store']);
Route::get('/people/show/{id}', [App\Http\Controllers\PeopleController::class, 'show']);
Route::patch('/people/update/{id}', [App\Http\Controllers\PeopleController::class, 'update']);
Route::delete('/people/destroy/{id}', [App\Http\Controllers\PeopleController::class, 'destroy']);

// Member Controller
Route::get('/people/members/index', [App\Http\Controllers\MemberController::class, 'index']);
Route::post('/people/members/store', [App\Http\Controllers\MemberController::class, 'store']);
Route::get('/people/members/show/{id}', [App\Http\Controllers\MemberController::class, 'show']);
Route::patch('/people/members/update/{id}', [App\Http\Controllers\MemberController::class, 'update']);
Route::delete('/people/members/destroy/{id}', [App\Http\Controllers\MemberController::class, 'destroy']);
Route::get('/people/members/membersbypeopleid/{id}', [App\Http\Controllers\MemberController::class, 'find_all_members_by_people_id']);

// Event Types Controller
Route::get('/events/types/index', [App\Http\Controllers\EventTypeController::class, 'index']);
Route::post('/events/types/store', [App\Http\Controllers\EventTypeController::class, 'store']);
Route::get('/events/types/show/{id}', [App\Http\Controllers\EventTypeController::class, 'show']);
Route::patch('/events/types/update/{id}', [App\Http\Controllers\EventTypeController::class, 'update']);
Route::delete('/events/types/destroy/{id}', [App\Http\Controllers\EventTypeController::class, 'destroy']);

// Event Controller
Route::get('/events/index', [App\Http\Controllers\EventController::class, 'index']);
Route::post('/events/store', [App\Http\Controllers\EventController::class, 'store']);
Route::get('/events/show/{id}', [App\Http\Controllers\EventController::class, 'show']);
Route::patch('/events/update/{id}', [App\Http\Controllers\EventController::class, 'update']);
Route::delete('/events/delete/{id}', [App\Http\Controllers\EventController::class, 'destroy']);
Route::get('/events/eventsbyeventtypeid/{id}', [App\Http\Controllers\EventController::class, 'find_all_events_by_event_type_id']);

// News Controller
Route::get('/news/index', [App\Http\Controllers\NewsController::class, 'index']);
Route::post('/news/store', [App\Http\Controllers\NewsController::class, 'store']);
Route::get('/news/show/{id}', [App\Http\Controllers\NewsController::class, 'show']);
Route::patch('/news/update/{id}', [App\Http\Controllers\NewsController::class, 'update']);
Route::delete('/news/delete/{id}', [App\Http\Controllers\NewsController::class, 'destroy']);

// News Controller
Route::get('/resource/index', [App\Http\Controllers\ResourceController::class, 'index']);
Route::post('/resource/store', [App\Http\Controllers\ResourceController::class, 'store']);
Route::get('/resource/show/{id}', [App\Http\Controllers\ResourceController::class, 'show']);
Route::patch('/resource/update/{id}', [App\Http\Controllers\ResourceController::class, 'update']);
Route::delete('/resource/delete/{id}', [App\Http\Controllers\ResourceController::class, 'destroy']);
