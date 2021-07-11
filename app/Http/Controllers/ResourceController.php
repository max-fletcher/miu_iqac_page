<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function index()
    {
        return response()->json(Resource::all() ,200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'resource_name' => ['required', 'string', 'max:255'],
            'resource_file' => ['required', 'file', 'max:5000']
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
            'resource_name' => $request->resource_name,
            'resource_file' => $filenameToStore
        ]);

        return response()->json( "Resource Created Successfully !!" ,201);
    }

    public function show($id)
    {
        $resource = Resource::find($id);
        if($resource){
            return response()->json($resource, 200);
        }

        return response()->json('The Provided ID doesn\'t match any Resource Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'resource_name' => ['required', 'string', 'max:255'],
            'resource_file' => ['required', 'file', 'max:5000']
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
            $resource->resource_name = $request->resource_name;            
            
            Storage::delete('public/resource_files/'.$resource->resource_file);  //deletes previous file
            //needs to use Illuminate\Support\Facades\Storage;
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
