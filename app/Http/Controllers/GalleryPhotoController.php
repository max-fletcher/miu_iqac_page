<?php

namespace App\Http\Controllers;

use App\Models\GalleryName;
use Illuminate\Http\Request;
use App\Models\GalleryPhoto;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryPhotoController extends Controller
{
    public function index()
    {
        return response()->json( GalleryPhoto::select('id', 'gallery_name_id', 'photo_title', 'photo_image', 'created_at')->orderBy('created_at', 'desc')->with('gallery_name')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'gallery_name_id' => ['required', 'numeric', 'integer', 'exists:gallery_names,id'],
            'photo_title' => ['required', 'string', 'max:255'],
            'photo_image' => [ 'required', 'image', 'max:2000'],
        ]);

        if($request->hasFile('photo_image')) {
            //get filename with extension
            $filenameWithExt = $request->file('photo_image')->getClientOriginalName();
            //get just file name (using standard php function)
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('photo_image')->getClientOriginalExtension();
            //filename to store(uses a time php function to get current time)
            //this string is a unique name so that file with duplicate name do not get uploaded and
            //cause problems when viewing(same problem that occured in CISV photo gallery)
            $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
            //upload image
            $request->file('photo_image')->storeAs('public/photo_gallery_images', $filenameToStore);
        }
        else{
            $filenameToStore = 'noimage.jpg';
        }

        GalleryPhoto::Create([
            'gallery_name_id' => $request->gallery_name_id,
            'photo_title' => $request->photo_title,
            'photo_image' => $filenameToStore,
        ]);

        return response()->json('Photo Saved Successfully !!', 201);
    }

    public function show($id)
    {
        $photo = GalleryPhoto::with('gallery_name')->where('id',$id)->first();
        if($photo){            
            return response()->json( $photo, 200);
        }

        return response()->json('The Provided ID doesn\'t match any Photos !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gallery_name_id' => ['required', 'numeric', 'integer', 'exists:gallery_names,id'],
            'photo_title' => ['required', 'string', 'max:255'],
            'photo_image' => [ 'required', 'image', 'max:2000'],
        ]);

        if($request->hasFile('photo_image')) {
            //get filename with extension
            $filenameWithExt = $request->file('photo_image')->getClientOriginalName();
            //get just file name (using standard php function)
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('photo_image')->getClientOriginalExtension();
            //filename to store(uses a time php function to get current time)
            //this string is a unique name so that file with duplicate name do not get uploaded and
            //cause problems when viewing(same problem that occured in CISV photo gallery)
            $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
            //upload image
            $request->file('photo_image')->storeAs('public/photo_gallery_images', $filenameToStore);
        }
        else{
            $filenameToStore = 'noimage.jpg';
        }

        $photo = GalleryPhoto::find($id);
        if ($photo) {
            $photo->gallery_name_id = $request->gallery_name_id;
            $photo->photo_title = $request->photo_title;            
            if($request->hasFile('photo_image')){     //works if there is a new image uploaded
                Storage::delete('public/photo_gallery_images/'.$photo->photo_image);  //deletes previous image
                //needs to use Illuminate\Support\Facades\Storage;
            }
            $photo->photo_image = $filenameToStore;
            $photo->save();
            return response()->json('Photo Updated Successfully !', 201);
        }

        return response()->json('The Provided ID doesn\'t match any Photos !!', 404);
    }

    public function destroy($id)
    {        
        $photo = GalleryPhoto::find($id);
        if ($photo) {
            Storage::delete('public/photo_gallery_images/'.$photo->photo_image);  //deletes image
            $photo->delete();
            return response()->json('Photo Deleted Successfully !', 201);
        }

        return response()->json('The Provided ID doesn\'t match any Photos !!', 404);
    }

    public function photos_by_gallery_name_id($id)
    {       
        $gallery = GalleryName::find($id);
        if ($gallery) {
            $photos = GalleryPhoto::with('gallery_name')->where('gallery_name_id', $id)->get();
            return response()->json($photos, 200);
        }
        return response()->json('The Provided ID doesn\'t match any Photos !!', 404);
    }
}
