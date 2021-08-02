<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;

class PublicationController extends Controller
{
    public function index(){
        $publications = Publication::select('id', 'publication_type_info_id', 'created_at')->get();
        return response()->json( $publications , 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'publication_type_info_id' => ['required','numeric', 'integer', 'exists:publication_type_infos,id'],
        ]);

        Publication::create([
            'publication_type_info_id' => $request->publication_type_info_id,
        ]);

        return response()->json( 'Publication Successfully Added !!' , 201);
    }

    public function show($id)
    {
        $publication = Publication::where('id', $id)->select('id', 'publication_type_info_id', 'created_at')->first();
        if($publication){
            return response()->json($publication, 200);
        }

        return response()->json('Publication Not Found !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'publication_type_info_id' => ['required','numeric', 'integer', 'exists:publication_type_infos,id'],
        ]);

        $publication = Publication::find($id);

        if($publication){
            $publication->publication_type_info_id = $request->publication_type_info_id;
            $publication->save();
    
            return response()->json('Publication Updated Successfully', 201);
        }

        return response()->json('Publication With ID Not Found !!', 404);
    }

    public function destroy($id)
    {
        $publication = Publication::find($id);

        if($publication){        
            $publication->delete();
    
            return response()->json('Publication Deleted Successfully', 201);
        }

        return response()->json('Publication With ID Not Found !!', 404);
    }
}
