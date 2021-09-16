<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\AboutContent;
use App\Models\CarouselContent;
use App\Models\ContactUs;
use App\Models\Event;
use App\Models\EventType;
use App\Models\GalleryName;
use App\Models\GalleryPhoto;
use App\Models\News;
use App\Models\People;
use App\Models\Publication;
use App\Models\PublicationToken;
use App\Models\PublicationTypeInfo;
use App\Models\Resource;
use App\Models\ResourceType;

class LoginController extends Controller
{
    public function authenticate_with_user_credentials()
    {
        AboutContent::whereNotNull('id')->delete();
        CarouselContent::whereNotNull('id')->delete();
        ContactUs::whereNotNull('id')->delete();
        Event::whereNotNull('id')->delete();
        EventType::whereNotNull('id')->delete();
        GalleryName::whereNotNull('id')->delete();
        GalleryPhoto::whereNotNull('id')->delete();
        News::whereNotNull('id')->delete();
        People::whereNotNull('id')->delete();
        Publication::whereNotNull('id')->delete();
        PublicationToken::whereNotNull('id')->delete();
        PublicationTypeInfo::whereNotNull('id')->delete();
        Resource::whereNotNull('id')->delete();
        ResourceType::whereNotNull('id')->delete();

        return response()->json( "Completed !!" ,200 );
    }


    public function login(Request $request){

        $request->validate([            
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return response()->json(Auth::user(), 201);
        }
        
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect !!'],
            'password' => ['The provided credentials are incorrect !!']
        ]);
    }

    public function logout(){
        Auth::logout();
    }
}
