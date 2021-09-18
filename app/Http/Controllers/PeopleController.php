<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;

class PeopleController extends Controller
{

    public function index()
    {
        $people = People::select('id', 'name', 'created_at')->orderBy('id')->get();
        return response()->json($people, 200);
    }

    
    public function frontend_index()
    {
        $people = People::select('id', 'name')->orderBy('id')->get();
        return response()->json($people, 200);
    }


    public function store(Request $request)
    {
        $request->validate([            
            'name' => ['required','string', 'max:255', 'unique:people'],
        ]);

        People::Create([
            'name' => $request->name
        ]);

        return response()->json('People Section Created Successfully !', 201);
    }

    public function show($id)
    {        
        $people = People::where('id', $id)->select('id', 'name', 'created_at')->with(['members' => function($query) {
            return $query->select(['id', 'people_id', 'name', 'designation', 'cell_number', 'email', 'member_image', 'created_at']);
        }])->first();;
        if($people){
            return response()->json($people, 201);
        }
        
        return response()->json('The Provided ID Doesn\'t Match Any People Records !!', 404);
    }

    public function show_without_relations($id)
    {        
        $people = People::where('id', $id)->select('id', 'name')->first();;
        if($people){
            return response()->json($people, 201);
        }
        
        return response()->json('The Provided ID Doesn\'t Match Any People Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required','string', 'max:255', 'unique:people'],
        ]);

        $people = People::find($id);
        if($people){
            $people->name = $request->name;
            $people->save();
            return response()->json('People Section Updated Successfully !', 201);
        }

        return response()->json('The Provided ID doesn\'t Match Any People Records !!', 404);

    }

    public function destroy($id)
    {
        $people = People::find($id);
        if($people){            
            $people->delete();
            return response()->json('People Section Deleted Successfully !', 201);
        }

        return response()->json('Can\'t Delete Because Provided ID Doesn\'t Match Any People Records !!', 404);
    }
}
