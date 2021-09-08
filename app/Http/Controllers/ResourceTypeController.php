<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResourceType;

class ResourceTypeController extends Controller
{
    public function index()
    {        
        $resource_types = ResourceType::select('id', 'resource_type_name', 'created_at')->get();
        return response()->json($resource_types, 200);
    }

    // public function frontend_index()
    // {        
    //     $resource_types = ResourceType::select('id', 'resource_type_name', 'created_at')->with(['resources' => function($query) {
    //         return $query->select(['id', 'resource_type_id', 'resource_name', 'resource_file', 'created_at']);
    //     }])->get();
    //     return response()->json($resource_types, 200);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'resource_type_name' => ['required', 'string', 'max:255', 'unique:resource_types'],
        ]);

        ResourceType::create([
            'resource_type_name' => $request->resource_type_name,
        ]);

        return response()->json( 'Resource Type Successfully Added !!' , 201);
    }

    public function show($id)
    {
        $resource_type = ResourceType::where('id', $id)->select('id', 'resource_type_name', 'created_at')->with(['resources' => function($query) {
            return $query->select(['id', 'resource_type_id', 'resource_name', 'resource_file', 'created_at']);
        }])->first();
        if($resource_type){
            return response()->json($resource_type, 200);
        }

        return response()->json('Resource Type Not Found !!', 404);
    }

    public function show_without_relations($id)
    {
        $resource_type = ResourceType::where('id', $id)->select('id', 'resource_type_name', 'created_at')->first();
        if($resource_type){
            return response()->json($resource_type, 200);
        }

        return response()->json('Resource Type Not Found !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'resource_type_name' => ['required', 'string', 'max:255', 'unique:resource_types'],
        ]);

        $resource_type = ResourceType::find($id);

        if($resource_type){
            $resource_type->resource_type_name = $request->resource_type_name;
            $resource_type->save();
    
            return response()->json('Resource Type Updated Successfully !!', 201);
        }

        return response()->json('Resource Type With ID Not Found !!', 404);
    }

    public function destroy($id)
    {
        $resource_type = ResourceType::find($id);

        if($resource_type){        
            $resource_type->delete();
    
            return response()->json('Resource Type Deleted Successfully !!', 201);
        }

        return response()->json('Resource Type With ID Not Found !!', 404);
    }
}
