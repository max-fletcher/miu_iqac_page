<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutContentType;

class AboutContentTypeController extends Controller
{
    public function index()
    {
        return response()->json(AboutContentType::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', 'string', 'max:255', 'unique:about_content_types'],
        ]);

        AboutContentType::Create([
            'type' => $request->type,
        ]);

        return response()->json('About Content Type Created Successfully !', 201);
    }
    
    public function show($id)
    {
        $about_content_type = AboutContentType::find($id);
        if($about_content_type){
            return response()->json( $about_content_type, 200 );
        }
        return response()->json('The Provided ID doesn\'t match any Content Type Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => ['required', 'string', 'max:255', 'unique:about_content_types'],
        ]);

        $content_type = AboutContentType::find($id);
        if($content_type){
            $content_type->type = $request->type;
            $content_type->save();
            return response()->json('About Content Type Updated Successfully !', 201);
        }        
        
        return response()->json('The Provided ID doesn\'t match any Content Type Records !!', 404);
    }

    public function destroy($id)
    {
        $content_type = AboutContentType::find($id);
        if($content_type){            
            $content_type->delete();
            return response()->json('Content Type Destroyed Successfully !', 201);
        }

        return response()->json('Can\'t delete because provided ID doesn\'t match any Content Type Records !!', 404);
    }

    public function content_type_without_content()
    {
        // return empty if all content types (model) are used at least once
        $contents = AboutContentType::doesntHave('about_contents')->get();
        return response()->json($contents, 201);
    }
}
