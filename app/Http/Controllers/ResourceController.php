<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Resource;

use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    public function index()
    {        
        $resources = Resource::select('id', 'resource_type_id', 'resource_name', 'resource_file', 'created_at')->get();
        return response()->json($resources ,200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'resource_type_id' => ['required','numeric', 'integer', 'exists:resource_types,id'],
            'resource_name' => ['required', 'string', 'max:255'],
            'resource_file' => ['required', 'file', 'mimetypes:application/pdf', 'max:50000']
        ]);
        
        //get filename with extension
        $filenameWithExt = $request->file('resource_file')->getClientOriginalName();
        //get just file name (using standard php function)
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just extension
        $extension = $request->file('resource_file')->getClientOriginalExtension();
        //filename to store(uses a time php function to get current time)
        //this string is a unique name so that file with duplicate name do not get uploaded and
        //cause problems when viewing(same problem that occured in CISV photo gallery)
        $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
        //upload image
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
        $resource = Resource::where('id', $id)->with('resource_type')->get();
        if($resource){
            return response()->json($resource, 200);
        }

        return response()->json('The Provided ID doesn\'t match any Resource Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'resource_type_id' => ['required','numeric', 'integer', 'exists:resource_types,id'],
            'resource_name' => ['required', 'string', 'max:255'],
            'resource_file' => ['required', 'file', 'mimetypes:application/pdf', 'max:50000']
        ]);

            //get filename with extension
            $filenameWithExt = $request->file('resource_file')->getClientOriginalName();
            //get just file name (using standard php function)
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('resource_file')->getClientOriginalExtension();
            //filename to store(uses a time php function to get current time)
            //this string is a unique name so that file with duplicate name do not get uploaded and
            //cause problems when viewing(same problem that occured in CISV photo gallery)
            $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
            //upload image
            $request->file('resource_file')->storeAs('public/resource_files', $filenameToStore);

        $resource = Resource::find($id);
        if($resource){
            $resource->resource_type_id = $request->resource_type_id;
            $resource->resource_name = $request->resource_name;            
            Storage::delete('public/resource_files/'.$resource->resource_file);
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
