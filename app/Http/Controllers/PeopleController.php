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
        $people = People::find($id);
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
