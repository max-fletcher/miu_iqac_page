<?php

namespace App\Http\Controllers;

use App\Models\PublicationTypeInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\NoWhitespace;

class PublicationTypeInfoController extends Controller
{
    public function index(){
        $publication_types = PublicationTypeInfo::select('id', 'publication_type_name', 'publication_password', 'created_at')->get();
        return response()->json( $publication_types , 200);
    }

    public function frontend_index(){
        $publication_types = PublicationTypeInfo::select('id', 'publication_type_name', 'created_at')->get();
        return response()->json( $publication_types , 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'publication_type_name' => ['required', 'string', 'max:255', 'unique:publication_type_infos'],
            'publication_password' => ['required', 'string', 'min:8' ,'max:255', 'confirmed', new NoWhitespace],
        ]);

        PublicationTypeInfo::create([
            'publication_type_name' => $request->publication_type_name,
            'publication_password' => Hash::make($request->publication_password)
        ]);

        return response()->json( 'Publication Type Successfully Added !!' , 201);
    }

    public function show($id)
    {
        $publication_type = PublicationTypeInfo::where('id', $id)->select('id', 'publication_type_name', 'created_at')->first();
        if($publication_type){
            return response()->json($publication_type, 200);
        }

        return response()->json('Publication Type Not Found !!', 404);
    }

    public function show_with_publications($id)
    {
        $publication_type = PublicationTypeInfo::where('id', $id)->select('id', 'publication_type_name', 'created_at')->with(['publications' => function($query) {
            return $query->select(['id', 'publication_type_info_id', 'publication_name', 'publication_file', 'created_at']);
        }])->first();
        if($publication_type){
            return response()->json($publication_type, 200);
        }

        return response()->json('Publication Type Not Found !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'publication_type_name' => ['required', 'string', 'max:255'],
            'publication_password' => ['required', 'min:8' ,'max:255', 'confirmed', new NoWhitespace],
        ]);

        $publication_type = PublicationTypeInfo::find($id);
        $duplicate_publication = PublicationTypeInfo::where('publication_type_name', $request->publication_type_name)->where('id', '!=' ,$publication_type->id)->first();

        if($publication_type){
            if(!$duplicate_publication){
                $publication_type->publication_type_name = $request->publication_type_name;
                $publication_type->publication_password = Hash::make($request->publication_password);
                $publication_type->save();
                return response()->json('Publication Type Updated Successfully !!', 201);
            }
            else{
                return response()->json('Publication Type with this name already exists !!', 422);
            }
        }

        return response()->json('Publication Type With ID Not Found !!', 404);
    }

    public function destroy($id)
    {
        $publication_type = PublicationTypeInfo::find($id);

        if($publication_type){        
            $publication_type->delete();
    
            return response()->json('Publication Type Deleted Successfully !!', 201);
        }

        return response()->json('Publication Type With ID Not Found !!', 404);
    }
}
