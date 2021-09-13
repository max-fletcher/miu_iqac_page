<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function index(){
        $publications = Publication::select('id', 'publication_type_info_id', 'publication_name', 'publication_file', 'created_at')->get();
        return response()->json( $publications , 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'publication_type_info_id' => ['required','numeric', 'integer', 'exists:publication_type_infos,id'],
            'publication_name' => ['required', 'string', 'max:255'],
            'publication_file' => ['required', 'file', 'mimetypes:application/pdf', 'max:50000']
        ]);

        //get filename with extension
        $filenameWithExt = $request->file('publication_file')->getClientOriginalName();
        //get just file name (using standard php function)
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just extension
        $extension = $request->file('publication_file')->getClientOriginalExtension();
        //filename to store(uses a time php function to get current time)
        //this string is a unique name so that file with duplicate name do not get uploaded and
        //cause problems when viewing(same problem that occured in CISV photo gallery)
        $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
        //upload image
        $request->file('publication_file')->storeAs('public/publication_files', $filenameToStore);

        Publication::create([
            'publication_type_info_id' => $request->publication_type_info_id,
            'publication_name' => $request->publication_name,
            'publication_file' => $filenameToStore,
        ]);

        return response()->json( 'Publication Successfully Added !!' , 201);
    }

    public function show($id)
    {
        $publication = Publication::where('id', $id)->select('id', 'publication_type_info_id', 'publication_name', 'publication_file', 'created_at')->with(['publication_type_info' => function($query){
            return $query->select(['id', 'publication_type_name']);
        }])->first();
        if($publication){
            return response()->json($publication, 200);
        }

        return response()->json('Publication Not Found !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'publication_type_info_id' => ['required','numeric', 'integer', 'exists:publication_type_infos,id'],
            'publication_name' => ['required', 'string', 'max:255'],
        ]);

        $publication = Publication::find($id);
        if($publication){

            if($request->hasFile('publication_file')) {

                $request->validate([
                    'publication_file' => ['required', 'file', 'mimetypes:application/pdf', 'max:50000']
                ]);
                
                Storage::delete('public/publication_files/'.$publication->publication_file);
                //get filename with extension
                $filenameWithExt = $request->file('publication_file')->getClientOriginalName();
                //get just file name (using standard php function)
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file('publication_file')->getClientOriginalExtension();
                //filename to store(uses a time php function to get current time)
                //this string is a unique name so that file with duplicate name do not get uploaded and
                //cause problems when viewing(same problem that occured in CISV photo gallery)
                $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
                //upload image
                $request->file('publication_file')->storeAs('public/publication_files', $filenameToStore);
            }
            else{
                $filenameToStore = $publication->publication_file;
            }

            $publication->publication_type_info_id = $request->publication_type_info_id;
            $publication->publication_name = $request->publication_name;
            $publication->publication_file = $filenameToStore;
            $publication->save();
    
            return response()->json('Publication Updated Successfully !!', 201);
        }

        return response()->json('Publication With ID Not Found !!', 404);
    }

    public function destroy($id)
    {
        $publication = Publication::find($id);

        if($publication){            
            Storage::delete('public/publication_files/'.$publication->publication_file);                            
            $publication->delete();
    
            return response()->json('Publication Deleted Successfully !!', 201);
        }

        return response()->json('Publication With ID Not Found !!', 404);
    }
}
