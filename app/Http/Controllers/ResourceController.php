<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Resource;

class ResourceController extends Controller
{
    // public function index()
    // {        
    //     $resources = Resource::select('id', 'resource_type_id', 'resource_name', 'resource_file', 'created_at')->get();
    //     return response()->json($resources ,200);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'resource_type_id' => ['required','numeric', 'integer', 'exists:resource_types,id'],
            'resource_name' => ['required', 'string', 'max:255'],
            'resource_file' => ['required', 'file', 'mimetypes:application/pdf', 'max:50000']
        ]);
        
        $filenameWithExt = $request->file('resource_file')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('resource_file')->getClientOriginalExtension();
        $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
        $request->file('resource_file')->storeAs('public/resource_files', $filenameToStore);

        Resource::Create([
            'resource_type_id' => $request->resource_type_id,
            'resource_name' => $request->resource_name,
            'resource_file' => $filenameToStore,            
        ]);

        return response()->json( "Resource Created Successfully !!" ,201);
    }

    public function show($id)
    {
        $resource = Resource::where('id', $id)->with('resource_type')->first();
        if($resource){
            return response()->json($resource, 200);
        }

        return response()->json('The Provided ID doesn\'t match any Resource Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'resource_type_id' => ['required','numeric', 'integer', 'exists:resource_types,id'],
            'resource_name' => ['required', 'string', 'max:255']
        ]);

        $resource = Resource::find($id);
        if($resource){

            if($request->hasFile('resource_file')) {

                $request->validate([
                    'resource_file' => ['required', 'file', 'mimetypes:application/pdf', 'max:50000']
                ]);

                Storage::delete('public/resource_files/'.$resource->resource_file);

                $filenameWithExt = $request->file('resource_file')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('resource_file')->getClientOriginalExtension();
                $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
                $request->file('resource_file')->storeAs('public/resource_files', $filenameToStore);

            }
            else{
                $filenameToStore = $resource->resource_file;
            }
            
            $resource->resource_type_id = $request->resource_type_id;
            $resource->resource_name = $request->resource_name;
            $resource->resource_file = $filenameToStore;
            $resource->save();
            return response()->json( "Resource Updated Successfully !!" ,201);
        }

        return response()->json('The Provided ID doesn\'t match any Resource Records !!', 404);

    }

    public function destroy($id)
    {
        $resource = Resource::find($id);
        if($resource){
            Storage::delete('public/resource_files/'.$resource->resource_file);  //deletes iamge
            $resource->delete();
            return response()->json( "Resource Deleted Successfully !!" ,201);
        }

        return response()->json('The Provided ID doesn\'t match any Resource Records !!', 404);
    }
}
