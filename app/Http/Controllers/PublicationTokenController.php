<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicationTypeInfo;
use App\Models\PublicationToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PublicationTokenController extends Controller
{
    public function create_publication_token(Request $request){        

        $request->validate([
            'publication_type_info_id' => ['required', 'numeric', 'integer'],
            'publication_password' => ['required', 'string','min:8' ,'max:255'],
        ]);

        $publication_type_info = PublicationTypeInfo::find($request->publication_type_info_id);
        if(!$publication_type_info || !Hash::check( $request->publication_password, $publication_type_info->publication_password )){
            return response()->json( 'Bad Credentials !!', 401 );
        }        

        $token = PublicationToken::create([
            'publication_type_info_id' => $request->publication_type_info_id,
            'publication_token' => Str::random(50)
        ]);

        return response( $token, 201 );
    }
}
