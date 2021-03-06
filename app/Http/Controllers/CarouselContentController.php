<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CarouselContent;
use Intervention\Image\Facades\Image;
Use Illuminate\Support\Facades\File;
use App\Rules\noimage;

class CarouselContentController extends Controller
{
    public function index()
    {
        // return response()->json(CarouselContent::all() ,200);
        return response()->json(CarouselContent::select(['id', 'carousel_title', 'carousel_subtitle', 'carousel_image', 'created_at'])->get() ,200);
    }

    public function frontend_index()
    {
        return response()->json(CarouselContent::select(['carousel_title', 'carousel_subtitle', 'carousel_image'])->get() ,200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'carousel_title' => ['required', 'string', 'max:133'],
            'carousel_subtitle' => ['required', 'string', 'max:176'],
            'carousel_image' => ['required', 'image', 'max:3000', new noimage],
            'resize_image' => ['required', 'numeric', 'integer'],
        ]);

        $filenameWithExt = $request->file('carousel_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('carousel_image')->getClientOriginalExtension();
        $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
        $path = public_path('storage/carousel_images');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        if($request->resize_image == 1){
            $image = Image::make($request->file('carousel_image'))->resize(2000, 1150);
        }
        else{
            $image = Image::make($request->file('carousel_image'));
        }

        $image->save(public_path('storage/carousel_images/'. $filenameToStore));

        CarouselContent::Create([
            'carousel_title' => $request->carousel_title,
            'carousel_subtitle' => $request->carousel_subtitle,
            'carousel_image' => $filenameToStore
        ]);

        return response()->json( "Carousel Content Created Successfully !!" ,201);
    }

    public function show($id)
    {
        $carousel_content = CarouselContent::find($id);
        if($carousel_content){
            return response()->json($carousel_content, 200);
        }

        return response()->json('The Provided ID Doesn\'t Match Any Carousel Content Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'carousel_title' => ['required', 'string', 'max:133'],
            'carousel_subtitle' => ['required', 'string', 'max:176'],
        ]);

        $carousel_content = CarouselContent::find($id);
        if($carousel_content){

            
            if($request->hasFile('carousel_image')) {
                
                $request->validate([
                    'carousel_image' => ['required', 'image', 'max:3000', new noimage],
                    'resize_image' => ['required', 'numeric', 'integer'],
                ]);

                if($carousel_content->carousel_image != "noimage.jpg")
                    File::delete(public_path('storage/carousel_images/'.$carousel_content->carousel_image));

                $filenameWithExt = $request->file('carousel_image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('carousel_image')->getClientOriginalExtension();
                $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);

                $path = public_path('storage/carousel_images');
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }

                if($request->resize_image == 1){
                    $image = Image::make($request->file('carousel_image'))->resize(2000, 1150);
                }
                else{
                    $image = Image::make($request->file('carousel_image'));
                }

                $image->save(public_path('storage/carousel_images/'. $filenameToStore));
            }
            else{
                $filenameToStore = $carousel_content->carousel_image;
            }

            $carousel_content->carousel_title = $request->carousel_title;
            $carousel_content->carousel_subtitle = $request->carousel_subtitle;
            $carousel_content->carousel_image = $filenameToStore;
            $carousel_content->save();
            return response()->json( "Carousel Content Updated Successfully !!" ,201);
        }

        return response()->json('The Provided ID Doesn\'t Match Any Carousel Content Records !!', 404);

    }

    public function destroy($id)
    {
        $carousel_content = CarouselContent::find($id);
        if($carousel_content){
            if($carousel_content->carousel_image != "noimage.jpg")
                File::delete(public_path('storage/carousel_images/'.$carousel_content->carousel_image));
            $carousel_content->delete();
            return response()->json( "Carousel Content Deleted Successfully !!" ,201);
        }

        return response()->json('The Provided ID Doesn\'t Match Any Carousel Content Records !!', 404);
    }
}
