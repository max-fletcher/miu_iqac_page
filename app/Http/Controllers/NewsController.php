<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
Use Illuminate\Support\Facades\File;
use App\Rules\noimage;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return response()->json($news ,200);
    }

    public function frontend_index()
    {
        $news = News::select('id', 'news_title', 'news_image', 'created_at')->orderBy('created_at', 'desc')->get();
        return response()->json($news ,200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'news_title' => ['required', 'string', 'max:255'],
            'news_text' => ['required', 'string'],
        ]);

        if($request->hasFile('news_image')) {

            $request->validate([
                'news_image' => [ 'image', 'sometimes', 'max:2000', new noimage],
                'resize_image' => ['required', 'numeric', 'integer'],
            ]);

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

            // Make Folder if it doesn't exist
            $path = public_path('storage/news_images');
            if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
            }

            // Resize image if needed and store it in $image variable
            // Save image to designated folder inside storage
            if($request->resize_image == 1){
                $image = Image::make($request->file('news_image'))->resize(2000, 1000);
            }
            else{
                $image = Image::make($request->file('news_image'));
            }

            $image->save(public_path('storage/news_images/'. $filenameToStore));
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

        return response()->json('The Provided ID Doesn\'t Match Any News Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'news_title' => ['required', 'string', 'max:255'],
            'news_text' => ['required', 'string'],
        ]);

        $news = News::find($id);
        if($news){
                
            if($request->hasFile('news_image')) {

                $request->validate([
                    'news_image' => ['required', 'image', 'max:2000', new noimage],
                    'resize_image' => ['required', 'numeric', 'integer'],
                ]);

                if($news->news_image != "noimage.jpg")
                    File::delete(public_path('storage/news_images/'.$news->news_image));  //deletes previous file

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
                
                // Make Folder if it doesn't exist
                $path = public_path('storage/news_images');
                if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                }

                // Resize image if needed and store it in $image variable
                // Save image to designated folder inside storage
                if($request->resize_image == 1){
                    $image = Image::make($request->file('news_image'))->resize(2000, 1000);
                }
                else{
                    $image = Image::make($request->file('news_image'));
                }

                $image->save(public_path('storage/news_images/'. $filenameToStore));
            }
            else{
                $filenameToStore = 'noimage.jpg';
            }

            $news->news_title = $request->news_title;
            $news->news_text = $request->news_text;
            $news->news_image = $filenameToStore;
            $news->save();
            return response()->json( "News Updated Successfully !!" ,201);
        }

        return response()->json('The Provided ID Doesn\'t Match Any News Records !!', 404);
    }

    public function destroy($id)
    {
        $news = News::find($id);
        if($news){
            if($news->news_image != "noimage.jpg")
                File::delete(public_path('storage/news_images/'.$news->news_image));  //deletes file
            $news->delete();
            return response()->json( "News Deleted Successfully !!" ,201);
        }

        return response()->json('The Provided ID Doesn\'t Match Any News Records !!', 404);
    }
}
