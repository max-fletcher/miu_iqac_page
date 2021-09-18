<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\GalleryName;
use App\Models\GalleryPhoto;
use Intervention\Image\Facades\Image;
Use Illuminate\Support\Facades\File;
use App\Http\Resources\GalleryPhotoResource;

class GalleryNameController extends Controller
{
    public function index()
    {
        $gallery_names = GalleryName::select('id', 'gallery_name', 'gallery_cover_photo', 'created_at')->orderBy('created_at', 'desc')->get();

        return response()->json( $gallery_names , 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'gallery_name' => ['required', 'string', 'max:255'],
            'gallery_cover_photo' => ['required', 'image', 'max:3000'],
            'resize_image' => ['required', 'numeric', 'integer'],
        ]);

        $filenameWithExt = $request->file('gallery_cover_photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('gallery_cover_photo')->getClientOriginalExtension();
        $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);

        $path = public_path('storage/gallery_cover_photos');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        if($request->resize_image == 1){
            $image = Image::make($request->file('gallery_cover_photo'))->resize(2000, 1150);
        }
        else{
            $image = Image::make($request->file('gallery_cover_photo'));
        }

        $image->save(public_path('storage/gallery_cover_photos/'. $filenameToStore));

        GalleryName::Create([
            'gallery_name' => $request->gallery_name,
            'gallery_cover_photo' => $filenameToStore
        ]);

        return response()->json( 'Gallery Successfully Added !!' , 201);
    }

    public function show($id)
    {

        $gallery_name = GalleryName::where('id', $id)->select('id', 'gallery_name','gallery_cover_photo' , 'created_at')->first();

        if($gallery_name){
            $gallery_photos = GalleryPhotoResource::collection(GalleryPhoto::where('gallery_name_id', $id)->get());
            $gallery_name->gallery_photos = $gallery_photos;
            return response()->json($gallery_name, 200);
        }

        return response()->json('Gallery Not Found !!', 404);
    }

    public function show_without_relations($id)
    {
        $gallery_name = GalleryName::where('id', $id)->select('id', 'gallery_name','gallery_cover_photo' , 'created_at')->first();

        if($gallery_name){
            return response()->json($gallery_name, 200);
        }

        return response()->json('Gallery Not Found !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gallery_name' => ['required', 'string', 'max:255'],
        ]);

        $gallery_name = GalleryName::find($id);
        if($gallery_name){

            if($request->hasFile('gallery_cover_photo')) {

                $request->validate([
                    'gallery_cover_photo' => ['required', 'image', 'max:3000'],
                    'resize_image' => ['required', 'numeric', 'integer'],
                ]);
                File::delete( public_path('storage/gallery_cover_photos/'.$gallery_name->gallery_cover_photo));
            
                $filenameWithExt = $request->file('gallery_cover_photo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('gallery_cover_photo')->getClientOriginalExtension();
                $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);

                $path = public_path('storage/gallery_cover_photos');
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }

                if($request->resize_image == 1){
                    $image = Image::make($request->file('gallery_cover_photo'))->resize(2000, 1150);
                }
                else{
                    $image = Image::make($request->file('gallery_cover_photo'));
                }

                $image->save(public_path('storage/gallery_cover_photos/'. $filenameToStore));

            }
            else{
                $filenameToStore = $gallery_name->gallery_cover_photo;
            }

            $gallery_name->gallery_name = $request->gallery_name;
            $gallery_name->gallery_cover_photo = $filenameToStore;
            $gallery_name->save();
            return response()->json('Gallery Updated Successfully !!', 201);
        }

        return response()->json('Gallery With ID Not Found !!', 404);
    }

    public function destroy($id)
    {
        $gallery_name = GalleryName::find($id);

        if($gallery_name){
            //deletes image
            File::delete( public_path('storage/gallery_cover_photos/'.$gallery_name->gallery_cover_photo ));
            // Storage::delete('public/gallery_cover_photos/'.$gallery_name->gallery_cover_photo);
            $gallery_name->delete();
            return response()->json('Gallery Deleted Successfully !!', 201);
        }

        return response()->json('Gallery With ID Not Found !!', 404);
    }
}
