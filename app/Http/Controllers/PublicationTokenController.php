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
            return response()->json( ['message' => 'Password Match Failed. Try Again.',], 401);
        }

        $token = PublicationToken::create([
            'publication_type_info_id' => $request->publication_type_info_id,
            'publication_token' => Str::random(50)
        ]);        

        return response()->json( $token, 201 );
    }

    public function token_exists(Request $request){
        
        $token = PublicationToken::where('publication_type_info_id', $request->publication_type_info_id)
        ->where('publication_token', $request->publication_token)->first();

        if($token){
            return response( 'token_exists', 201 );
        }

        return response()->json('no_token_exists', 404);
    }

    public function clear_tokens(){
        $tokens = PublicationToken::select('id')->get();
        
        if($tokens->count() > 100){
            PublicationToken::truncate();
            return response()->json('Cleared', 201);
        }
        
        return response()->json('NotYet', 201);
    }
}
