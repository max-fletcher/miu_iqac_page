<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{

    public function index()
    {
        return response()->json(News::all() ,200);
    }

    public function frontend_index()
    {
        $news = News::select('id', 'news_title', 'news_image', 'created_at')->get();
        return response()->json($news ,200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'news_title' => ['required', 'string', 'max:255'],
            'news_text' => ['required', 'string'],
            'news_image' => [ 'image', 'sometimes', 'max:2000']
        ]);

        if($request->hasFile('news_image')) {
            //get filename with extension
            $filenameWithExt = $request->file('news_image')->getClientOriginalName();
            //get just file name (using standard php function)
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('news_image')->getClientOriginalExtension();
            //filename to store(uses a time php function to get current time)
            //this string is a unique name so that file with duplicate name do not get uploaded and
            //cause problems when viewing(same problem that occured in CISV photo gallery)
            $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
            //upload image
            $request->file('news_image')->storeAs('public/news_images', $filenameToStore);
        }
        else{
            $filenameToStore = 'noimage.jpg';
        }

        News::Create([
            'news_title' => $request->news_title,
            'news_text' => $request->news_text,
            'news_image' => $filenameToStore
        ]);

        return response()->json( "News Created Successfully !!" ,201);
    }

    public function show($id)
    {
        $news = News::find($id);
        if($news){            
            return response()->json($news, 200);
        }

        return response()->json('The Provided ID doesn\'t match any News Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'news_title' => ['required', 'string', 'max:255'],
            'news_text' => ['required', 'string'],
            'news_image' => [ 'image', 'sometimes', 'max:2000']
        ]);

        if($request->hasFile('news_image')) {
            //get filename with extension
            $filenameWithExt = $request->file('news_image')->getClientOriginalName();
            //get just file name (using standard php function)
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('news_image')->getClientOriginalExtension();
            //filename to store(uses a time php function to get current time)
            //this string is a unique name so that file with duplicate name do not get uploaded and
            //cause problems when viewing(same problem that occured in CISV photo gallery)
            $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
            //upload image
            $request->file('news_image')->storeAs('public/news_images', $filenameToStore);
        }
        else{
            $filenameToStore = 'noimage.jpg';
        }

        $news = News::find($id);
        if($news){
            $news->news_title = $request->news_title;
            $news->news_text = $request->news_text;            
            if($request->hasFile('news_image')){     //works if there is a new image uploaded
                Storage::delete('public/news_images/'.$news->news_image);  //deletes previous image
                //needs to use Illuminate\Support\Facades\Storage;
                $news->news_image = $filenameToStore;
            }
            $news->save();
            return response()->json( "News Updated Successfully !!" ,201);
        }

        return response()->json('The Provided ID doesn\'t match any News Records !!', 404);

    }

    public function destroy($id)
    {
        $news = News::find($id);
        if($news){
            Storage::delete('public/news_images/'.$news->news_image);  //deletes iamge
            $news->delete();
            return response()->json( "News Deleted Successfully !!" ,201);
        }

        return response()->json('The Provided ID doesn\'t match any News Records !!', 404);
    }
}
