<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryName;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\GalleryNameResource;

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
            'gallery_cover_photo' => [ 'image', 'sometimes', 'max:2000'],
        ]);

        if($request->hasFile('gallery_cover_photo')) {
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
            //upload image
            $request->file('gallery_cover_photo')->storeAs('public/gallery_cover_photos', $filenameToStore);
        }
        else{
            $filenameToStore = 'noimage.jpg';
        }

        GalleryName::Create([
            'gallery_name' => $request->gallery_name,
            'gallery_cover_photo' => $filenameToStore
        ]);

        return response()->json( 'Gallery Successfully Added !!' , 201);
    }

    public function show($id)
    {        
        $gallery_name = new GalleryNameResource(GalleryName::where('id', $id)->select('id', 'gallery_name','gallery_cover_photo' , 'created_at')->with(['gallery_photos' => function($query) {
            return $query->select(['id', 'gallery_name_id', 'photo_title', 'photo_image', 'created_at']);
        }])->first());

        if($gallery_name){
            return response()->json($gallery_name, 200);
        }

        return response()->json('Gallery Not Found !!', 404);
    }
        

    public function update(Request $request, $id)
    {
        $request->validate([
            'gallery_name' => ['required', 'string', 'max:255'],
            'gallery_cover_photo' => [ 'image', 'sometimes', 'max:2000'],
        ]);

        if($request->hasFile('gallery_cover_photo')) {
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
            //upload image
            $request->file('gallery_cover_photo')->storeAs('public/gallery_cover_photos', $filenameToStore);
        }
        else{
            $filenameToStore = 'noimage.jpg';
        }

        $gallery_name = GalleryName::find($id);        
        if($gallery_name){
            $gallery_name->gallery_name = $request->gallery_name;
            if($request->hasFile('gallery_cover_photo')){     //works if there is a new image uploaded
                Storage::delete('public/gallery_cover_photos/'.$gallery_name->gallery_cover_photo);  //deletes previous image
                //needs to use Illuminate\Support\Facades\Storage;
            }
            $gallery_name->gallery_cover_photo = $filenameToStore;
            $gallery_name->save();
            return response()->json('Gallery Updated Successfully', 201);
        }

        return response()->json('Gallery With ID Not Found !!', 404);
    }

    public function destroy($id)
    {
        $gallery_name = GalleryName::find($id);

        if($gallery_name){        
            Storage::delete('public/gallery_cover_photos/'.$gallery_name->gallery_cover_photo);  //deletes image
            $gallery_name->delete();
            return response()->json('Gallery Deleted Successfully', 201);
        }

        return response()->json('Gallery With ID Not Found !!', 404);
    }
}
