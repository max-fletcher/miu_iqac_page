<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutContent;

class AboutContentController extends Controller
{
    public function index()
    {
        return response()->json(AboutContent::all(), 200);
    }

    public function frontend_index()
    {        
        $about_content = AboutContent::select('name','icon','content')->get();

        return response()->json($about_content, 200);
    }

    public function store(Request $request)
    {
        $request->validate([            
            'name' => ['required', 'string', 'unique:about_contents'],
            'content' => ['required', 'string'],
            'icon' => ['required', 'string'],
        ]);

        AboutContent::Create([
            'name' => $request->name,
            'content' => $request->content,
            'icon' => $request->icon,
        ]);

        return response()->json('About Content Created Successfully !', 201);
    }

    public function show($id)
    {
        $about_content = AboutContent::find($id);
        if($about_content){
            return response()->json( $about_content, 200 );
        }

        return response()->json('The Provided ID doesn\'t match any Content Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'content' => ['required', 'string'],
            'icon' => ['required', 'string'],
        ]);

        $duplicate_content = AboutContent::where('name', $request->name)->first();

        if( $duplicate_content && $duplicate_content->id != $id ){
            return response()->json('This content name is already taken !!', 404);
        }

        $about_content = AboutContent::find($id);
        if($about_content){
            $about_content->name = $request->name;
            $about_content->content = $request->content;
            $about_content->icon = $request->icon;
            $about_content->save();
            return response()->json('About Content Updated Successfully !', 201);
        }

        return response()->json('The Provided ID doesn\'t match any Content Records !!', 404);
    }

    public function destroy($id)
    {
        $about_content = AboutContent::find($id);
        if($about_content){            
            $about_content->delete();
            return response()->json('Content Destroyed Successfully !', 201);
        }

        return response()->json('Can\'t delete because provided ID doesn\'t match any Content Records !!', 404);
    }
}