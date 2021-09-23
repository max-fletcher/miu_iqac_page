<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
Use Illuminate\Support\Facades\File;
use App\Rules\noimage;


class EventController extends Controller
{
    // public function index()
    // {
    //     return response()->json( Event::orderBy('created_at', 'desc')->get(), 200);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'event_type_id' => ['required', 'numeric', 'integer', 'exists:event_types,id'],
            'event_name' => ['required', 'string', 'max:255'],
            'event_description' => ['required', 'string'],
            'event_date' => ['required', 'date'],
        ]);

        if($request->hasFile('event_image')) {

            $request->validate([
                'event_image' => ['required', 'image', 'max:2000', new noimage],
                'resize_image' => ['required', 'numeric', 'integer'],
            ]);

            $filenameWithExt = $request->file('event_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('event_image')->getClientOriginalExtension();
            $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
            
            $path = public_path('storage/event_images');
            if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
            }

            if($request->resize_image == 1){
                $image = Image::make($request->file('event_image'))->resize(2000, 1000);
            }
            else{
                $image = Image::make($request->file('event_image'));
            }

            $image->save(public_path('storage/event_images/'. $filenameToStore));
        }
        else{
            $filenameToStore = 'noimage.jpg';
        }

        Event::Create([
            'event_type_id' => $request->event_type_id,
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'event_image' => $filenameToStore,
            'event_date' => $request->event_date,
        ]);

        return response()->json('Event Saved Successfully !!', 201);
    }

    public function show($id)
    {
        $event = Event::with('event_type')->where('id',$id)->first();
        if($event){            
            return response()->json( $event, 200);
        }

        return response()->json('The Provided ID Doesn\'t Match Any Events !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'event_type_id' => ['required', 'numeric', 'integer', 'exists:event_types,id'],
            'event_name' => ['required', 'string', 'max:255'],
            'event_description' => ['required', 'string'],
            'event_date' => ['required', 'date'],
        ]);

        $event = Event::find($id);
        if ($event) {

            
            if($request->hasFile('event_image')) {
                
                $request->validate([
                    'event_image' => ['required', 'image', 'max:2000', new noimage],
                    'resize_image' => ['required', 'numeric', 'integer'],
                ]);
                
                if($event->event_image != "noimage.jpg")
                    File::delete(public_path('storage/event_images/'.$event->event_image));  //deletes previous file

                $filenameWithExt = $request->file('event_image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('event_image')->getClientOriginalExtension();
                $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);

                $path = public_path('storage/event_images');
                if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                }

                if($request->resize_image == 1){
                    $image = Image::make($request->file('event_image'))->resize(2000, 1000);
                }
                else{
                    $image = Image::make($request->file('event_image'));
                }

                $image->save(public_path('storage/event_images/'. $filenameToStore));
            }
            else{
                $filenameToStore = 'noimage.jpg';
            }

            $event->event_type_id = $request->event_type_id;
            $event->event_name = $request->event_name;
            $event->event_description = $request->event_description;
            $event->event_image = $filenameToStore;
            $event->event_date = $request->event_date;
            $event->save();
            return response()->json('Event Updated Successfully !!', 201);
        }

        return response()->json('The Provided ID Doesn\'t Match Any Events !!', 404);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if ($event) {
            if($event->event_image != "noimage.jpg")
                File::delete(public_path('storage/event_images/'.$event->event_image));  //deletes file
            $event->delete();
            return response()->json('Event Deleted Successfully !!', 201);
        }

        return response()->json('The Provided ID Doesn\'t Match Any Events !!', 404);
    }
}
