<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use GuzzleHttp\Promise\Create;

class PeopleController extends Controller
{

    public function index()
    {
        $people = People::all();
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

        return response()->json('People Created Successfully !', 201);
    }

    public function show($id)
    {        
        $people = People::where('id', $id)->select('id', 'name', 'created_at')->with(['members' => function($query) {
            return $query->select(['id', 'people_id', 'name', 'designation', 'cell_number', 'email', 'member_image', 'created_at']);
        }])->first();;
        if($people){
            return response()->json($people, 201);
        }
        
        return response()->json('The Provided ID doesn\'t match any People Records !!', 404);
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
            return response()->json('People Updated Successfully !', 201);
        }

        return response()->json('The Provided ID doesn\'t match any People Records !!', 404);

    }

    public function destroy($id)
    {
        $people = People::find($id);
        if($people){            
            $people->delete();
            return response()->json('People Destroyed Successfully !', 201);
        }

        return response()->json('Can\'t delete because provided ID doesn\'t match any People Records !!', 404);
    }
}
