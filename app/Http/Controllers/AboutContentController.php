<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutContent;
use App\Models\AboutContentType;

class AboutContentController extends Controller
{
    public function index()
    {
        return response()->json(AboutContent::with('about_content_type')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'about_content_type_id' => ['required', 'numeric', 'integer', 'unique:about_contents', 'exists:about_content_types,id'],
            'content' => ['required', 'string'],
            'icon' => ['required', 'string'],
        ]);

        AboutContent::Create([
            'about_content_type_id' => $request->about_content_type_id,
            'content' => $request->content,
            'icon' => $request->icon,
        ]);

        return response()->json('About Content Created Successfully !', 201);
    }

    public function show($id)
    {
        $content = AboutContent::with('about_content_type')->where('id', $id)->first();
        if($content){
            return response()->json( $content, 200 );
        }

        return response()->json('The Provided ID doesn\'t match any Content Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'about_content_type_id' => ['required', 'numeric', 'integer', 'unique:about_content_types', 'exists:about_content_types,id'],
            'content' => ['required', 'string'],
            'icon' => ['required', 'string'],
        ]);

        $content = AboutContent::find($id);
        if($content){
            $content->about_content_type_id = $request->about_content_type_id;
            $content->content = $request->content;
            $content->icon = $request->icon;
            $content->save();
            return response()->json('About Content Updated Successfully !', 201);
        }

        return response()->json('The Provided ID doesn\'t match any Content Records !!', 404);
    }

    public function destroy($id)
    {
        $content = AboutContent::find($id);
        if($content){            
            $content->delete();
            return response()->json('Content Destroyed Successfully !', 201);
        }

        return response()->json('Can\'t delete because provided ID doesn\'t match any Content Records !!', 404);
    }

    public function find_all_content_by_type_id($id)
    {
        $content = AboutContent::with('about_content_type')->where('about_content_type_id', $id)->get();
        return response()->json($content, 201);
    }
}