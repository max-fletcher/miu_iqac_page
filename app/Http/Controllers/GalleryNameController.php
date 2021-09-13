<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\GalleryName;
use App\Models\GalleryPhoto;
use Intervention\Image\Facades\Image;
Use Illuminate\Support\Facades\File;
// use App\Http\Resources\GalleryNameResource;
use App\Http\Resources\GalleryPhotoResource;
// use App\Rules\noimage;

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

        //get filename with extension
        $filenameWithExt = $request->file('gallery_cover_photo')->getClientOriginalName();
        //get just file name (using standard php function)
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just extension
        $extension = $request->file('gallery_cover_photo')->getClientOriginalExtension();
        //filename to store(uses a time php function to get current time)
        //this string is a unique name so that file with duplicate name do not get uploaded and
        //cause problems when viewing(same problem that occured in CISV photo gallery)
        $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
        // //upload image
        // $request->file('gallery_cover_photo')->storeAs('public/gallery_cover_photos', $filenameToStore);

        // Make Folder if it doesn't exist
        $path = public_path('storage/gallery_cover_photos');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        // Resize image if needed and store it in $image variable
        // Save image to designated folder inside storage
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
        // $gallery_name = new GalleryNameResource(GalleryName::where('id', $id)->select('id', 'gallery_name','gallery_cover_photo' , 'created_at')->with(['gallery_photos' => function($query) {
        //     return $query->select(['id', 'gallery_name_id', 'photo_title', 'photo_image', 'created_at']);
        // }])->first());

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
                // deletes previous file
                // if($gallery_name->gallery_cover_photo != "noimage.jpg")
                File::delete( public_path('storage/gallery_cover_photos/'.$gallery_name->gallery_cover_photo));
                // Storage::delete('public/carousel_images/'.$carousel_content->carousel_image);
            
                //get filename with extension
                $filenameWithExt = $request->file('gallery_cover_photo')->getClientOriginalName();
                //get just file name (using standard php function)
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file('gallery_cover_photo')->getClientOriginalExtension();
                //filename to store(uses a time php function to get current time)
                //this string is a unique name so that file with duplicate name do not get uploaded and
                //cause problems when viewing(same problem that occured in CISV photo gallery)
                $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);

                // Make Folder if it doesn't exist
                $path = public_path('storage/gallery_cover_photos');
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }

                // Resize image if needed and store it in $image variable
                // Save image to designated folder inside storage
                if($request->resize_image == 1){
                    $image = Image::make($request->file('gallery_cover_photo'))->resize(2000, 1150);
                }
                else{
                    $image = Image::make($request->file('gallery_cover_photo'));
                }

                $image->save(public_path('storage/gallery_cover_photos/'. $filenameToStore));

                //upload image
                // $request->file('gallery_cover_photo')->storeAs('public/gallery_cover_photos', $filenameToStore);
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
