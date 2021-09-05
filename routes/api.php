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

// Needs Authentication
Route::middleware('auth:sanctum')->group(function () {
    // FE
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/authenticated', function(){
        return true;
    });
});

// Authentication Controllers
// FE
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register']);
// FE
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
// FE
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout']);

// Refactor Controller to use Restful Controllers later maybe

// Carousel Content Controller
// BE
Route::get('/carouselcontent/index', [App\Http\Controllers\CarouselContentController::class, 'index']);
// FE
Route::get('/carouselcontent/frontend_index', [App\Http\Controllers\CarouselContentController::class, 'frontend_index']);
// BE
Route::post('/carouselcontent/store', [App\Http\Controllers\CarouselContentController::class, 'store']);
// BE
Route::get('/carouselcontent/show/{id}', [App\Http\Controllers\CarouselContentController::class, 'show']);
// BE
Route::patch('/carouselcontent/update/{id}', [App\Http\Controllers\CarouselContentController::class, 'update']);
//BE
Route::delete('/carouselcontent/destroy/{id}', [App\Http\Controllers\CarouselContentController::class, 'destroy']);

// About Content Controller
// BE
Route::get('/about/content/index', [App\Http\Controllers\AboutContentController::class, 'index']);
// FE
Route::get('/about/content/frontend_index', [App\Http\Controllers\AboutContentController::class, 'frontend_index']);
// BE
Route::post('/about/content/store', [App\Http\Controllers\AboutContentController::class, 'store']);
// BE
Route::get('/about/content/show/{id}', [App\Http\Controllers\AboutContentController::class, 'show']);
// BE
Route::patch('/about/content/update/{id}', [App\Http\Controllers\AboutContentController::class, 'update']);
// BE
Route::delete('/about/content/destroy/{id}', [App\Http\Controllers\AboutContentController::class, 'destroy']);

// People Controller
// BE
Route::get('/people/index', [App\Http\Controllers\PeopleController::class, 'index']);
// FE
Route::get('/people/frontend_index', [App\Http\Controllers\PeopleController::class, 'frontend_index']);
// BE
Route::post('/people/store', [App\Http\Controllers\PeopleController::class, 'store']);
// FE
Route::get('/people/show/{id}', [App\Http\Controllers\PeopleController::class, 'show']);
// BE
Route::get('/people/show_without_relations/{id}', [App\Http\Controllers\PeopleController::class, 'show_without_relations']);
// BE
Route::patch('/people/update/{id}', [App\Http\Controllers\PeopleController::class, 'update']);
// BE
Route::delete('/people/destroy/{id}', [App\Http\Controllers\PeopleController::class, 'destroy']);

// Member Controller
Route::get('/people/members/index', [App\Http\Controllers\MemberController::class, 'index']);
// BE
Route::post('/people/members/store', [App\Http\Controllers\MemberController::class, 'store']);
// BE
Route::get('/people/members/show/{id}', [App\Http\Controllers\MemberController::class, 'show']);
// BE
Route::patch('/people/members/update/{id}', [App\Http\Controllers\MemberController::class, 'update']);
// BE
Route::delete('/people/members/destroy/{id}', [App\Http\Controllers\MemberController::class, 'destroy']);
Route::get('/people/members/membersbypeopleid/{id}', [App\Http\Controllers\MemberController::class, 'find_all_members_by_people_id']);

// Event Types Controller
// FE
Route::get('/events/types/index', [App\Http\Controllers\EventTypeController::class, 'index']);
// Route::get('/events/types/frontend_index', [App\Http\Controllers\EventTypeController::class, 'frontend_index']);
// BE
Route::post('/events/types/store', [App\Http\Controllers\EventTypeController::class, 'store']);
// BE
Route::get('/events/types/show/{id}', [App\Http\Controllers\EventTypeController::class, 'show']);
// BE
Route::get('/events/types/show_with_events/{id}', [App\Http\Controllers\EventTypeController::class, 'show_with_events']);
// BE
Route::patch('/events/types/update/{id}', [App\Http\Controllers\EventTypeController::class, 'update']);
Route::delete('/events/types/destroy/{id}', [App\Http\Controllers\EventTypeController::class, 'destroy']);
// FE
Route::get('/events/types/show_sorted/{id}', [App\Http\Controllers\EventTypeController::class, 'show_sorted']);

// Event Controller
Route::get('/events/index', [App\Http\Controllers\EventController::class, 'index']);
Route::post('/events/store', [App\Http\Controllers\EventController::class, 'store']);
// FE
Route::get('/events/show/{id}', [App\Http\Controllers\EventController::class, 'show']);
// BE
Route::patch('/events/update/{id}', [App\Http\Controllers\EventController::class, 'update']);
Route::delete('/events/destroy/{id}', [App\Http\Controllers\EventController::class, 'destroy']);
Route::get('/events/upcoming/eventsbyeventtypeid/{id}', [App\Http\Controllers\EventController::class, 'upcoming_events_by_event_type_id']);
Route::get('/events/passed/eventsbyeventtypeid/{id}', [App\Http\Controllers\EventController::class, 'passed_events_by_event_type_id']);

// News Controller
Route::get('/news/index', [App\Http\Controllers\NewsController::class, 'index']);
// FE
Route::get('/news/frontend_index', [App\Http\Controllers\NewsController::class, 'frontend_index']);
Route::post('/news/store', [App\Http\Controllers\NewsController::class, 'store']);
// FE
Route::get('/news/show/{id}', [App\Http\Controllers\NewsController::class, 'show']);
Route::patch('/news/update/{id}', [App\Http\Controllers\NewsController::class, 'update']);
Route::delete('/news/destroy/{id}', [App\Http\Controllers\NewsController::class, 'destroy']);

// Resource Types Controller
// FE
Route::get('/resource_type/index', [App\Http\Controllers\ResourceTypeController::class, 'index']);
Route::get('/resource_type/frontend_index', [App\Http\Controllers\ResourceTypeController::class, 'frontend_index']);
Route::post('/resource_type/store', [App\Http\Controllers\ResourceTypeController::class, 'store']);
// FE
Route::get('/resource_type/show/{id}', [App\Http\Controllers\ResourceTypeController::class, 'show']);
Route::patch('/resource_type/update/{id}', [App\Http\Controllers\ResourceTypeController::class, 'update']);
Route::delete('/resource_type/destroy/{id}', [App\Http\Controllers\ResourceTypeController::class, 'destroy']);

// Resource Controller
// FE
Route::get('/resource/index', [App\Http\Controllers\ResourceController::class, 'index']);
Route::post('/resource/store', [App\Http\Controllers\ResourceController::class, 'store']);
Route::get('/resource/show/{id}', [App\Http\Controllers\ResourceController::class, 'show']);
Route::patch('/resource/update/{id}', [App\Http\Controllers\ResourceController::class, 'update']);
Route::delete('/resource/destroy/{id}', [App\Http\Controllers\ResourceController::class, 'destroy']);

// Contact Us Controller
Route::get('/contact_us/index', [App\Http\Controllers\ContactUsController::class, 'index']);
// FE
Route::post('/contact_us/store', [App\Http\Controllers\ContactUsController::class, 'store']);
Route::get('/contact_us/show/{id}', [App\Http\Controllers\ContactUsController::class, 'show']);
Route::patch('/contact_us/update/{id}', [App\Http\Controllers\ContactUsController::class, 'update']);
Route::delete('/contact_us/destroy/{id}', [App\Http\Controllers\ContactUsController::class, 'destroy']);

// Gallery Name Controller
// FE
Route::get('/gallery/name/index', [App\Http\Controllers\GalleryNameController::class, 'index']);
Route::get('/gallery/name/frontend_index', [App\Http\Controllers\GalleryNameController::class, 'frontend_index']);
Route::post('/gallery/name/store', [App\Http\Controllers\GalleryNameController::class, 'store']);
// FE
Route::get('/gallery/name/show/{id}', [App\Http\Controllers\GalleryNameController::class, 'show']);
Route::patch('/gallery/name/update/{id}', [App\Http\Controllers\GalleryNameController::class, 'update']);
Route::delete('/gallery/name/destroy/{id}', [App\Http\Controllers\GalleryNameController::class, 'destroy']);

// Gallery Photos Controller
Route::get('/gallery/photos/index', [App\Http\Controllers\GalleryPhotoController::class, 'index']);
Route::post('/gallery/photos/store', [App\Http\Controllers\GalleryPhotoController::class, 'store']);
Route::get('/gallery/photos/show/{id}', [App\Http\Controllers\GalleryPhotoController::class, 'show']);
Route::patch('/gallery/photos/update/{id}', [App\Http\Controllers\GalleryPhotoController::class, 'update']);
Route::delete('/gallery/photos/destroy/{id}', [App\Http\Controllers\GalleryPhotoController::class, 'destroy']);
Route::get('/gallery/photos/photosbygalleryid/{id}', [App\Http\Controllers\GalleryPhotoController::class, 'photos_by_gallery_name_id']);

// Publication Types Controller
Route::get('/publication_type_info/index', [App\Http\Controllers\PublicationTypeInfoController::class, 'index']);
// FE
Route::get('/publication_type_info/frontend_index', [App\Http\Controllers\PublicationTypeInfoController::class, 'frontend_index']);
Route::post('/publication_type_info/store', [App\Http\Controllers\PublicationTypeInfoController::class, 'store']);
// FE
Route::get('/publication_type_info/show/{id}', [App\Http\Controllers\PublicationTypeInfoController::class, 'show']);
// FE
Route::get('/publication_type_info/show_with_publications/{id}', [App\Http\Controllers\PublicationTypeInfoController::class, 'show_with_publications']);
Route::patch('/publication_type_info/update/{id}', [App\Http\Controllers\PublicationTypeInfoController::class, 'update']);
Route::delete('/publication_type_info/destroy/{id}', [App\Http\Controllers\PublicationTypeInfoController::class, 'destroy']);

// Publications Controller
Route::get('/publications/index', [App\Http\Controllers\PublicationController::class, 'index']);
Route::post('/publications/store', [App\Http\Controllers\PublicationController::class, 'store']);
Route::get('/publications/show/{id}', [App\Http\Controllers\PublicationController::class, 'show']);
Route::patch('/publications/update/{id}', [App\Http\Controllers\PublicationController::class, 'update']);
Route::delete('/publications/destroy/{id}', [App\Http\Controllers\PublicationController::class, 'destroy']);

//Publication Token
// FE
Route::post('/publication_token/create_token', [App\Http\Controllers\PublicationTokenController::class, 'create_publication_token']);
//FE
Route::post('/publication_token/token_exists', [App\Http\Controllers\PublicationTokenController::class, 'token_exists']);
// FE
Route::get('/publication_token/clear_tokens', [App\Http\Controllers\PublicationTokenController::class, 'clear_tokens']);