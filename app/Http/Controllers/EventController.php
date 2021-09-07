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
    public function index()
    {
        return response()->json( Event::orderBy('created_at', 'desc')->get(), 200);
    }

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

            //get filename with extension
            $filenameWithExt = $request->file('event_image')->getClientOriginalName();
            //get just file name (using standard php function)
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('event_image')->getClientOriginalExtension();
            //filename to store(uses a time php function to get current time)
            //this string is a unique name so that file with duplicate name do not get uploaded and
            //cause problems when viewing(same problem that occured in CISV photo gallery)
            $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
            
            // Make Folder if it doesn't exist
            $path = public_path('storage/event_images');
            if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
            }

            // Resize image if needed and store it in $image variable
            // Save image to designated folder inside storage
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

        return response()->json('The Provided ID doesn\'t match any Events !!', 404);
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

                //get filename with extension
                $filenameWithExt = $request->file('event_image')->getClientOriginalName();
                //get just file name (using standard php function)
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file('event_image')->getClientOriginalExtension();
                //filename to store(uses a time php function to get current time)
                //this string is a unique name so that file with duplicate name do not get uploaded and
                //cause problems when viewing(same problem that occured in CISV photo gallery)
                $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);

                // Make Folder if it doesn't exist
                $path = public_path('storage/event_images');
                if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                }

                // Resize image if needed and store it in $image variable
                // Save image to designated folder inside storage
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
            return response()->json('Event Updated Successfully !', 201);
        }

        return response()->json('The Provided ID doesn\'t match any Events !!', 404);
    }

    public function destroy($id)
    {        
        $event = Event::find($id);
        if ($event) {
            if($event->event_image != "noimage.jpg")
                File::delete(public_path('storage/event_images/'.$event->event_image));  //deletes file
            $event->delete();
            return response()->json('Event Deleted Successfully !', 201);
        }

        return response()->json('The Provided ID doesn\'t match any Events !!', 404);
    }

    // public function upcoming_events_by_event_type_id($id)
    // {        
    //     $event_type = EventType::find($id);
    //     if($event_type){
    //         $events = Event::with('event_type')->where('event_type_id', $id)->where('event_date', '>=', Carbon::now())->orderBy('event_date', 'desc')->get();
    //         return response()->json($events, 200);
    //     }

    //     return response()->json('The Provided ID doesn\'t match any Events !!', 404);
    // }

    // public function passed_events_by_event_type_id($id)
    // {      
    //     $event_type = EventType::find($id);
    //     if($event_type){
    //         $events = Event::with('event_type')->where('event_type_id', $id)->where('event_date', '<', Carbon::now())->orderBy('event_date', 'desc')->get();
    //         return response()->json($events, 200);
    //     }

    //     return response()->json('The Provided ID doesn\'t match any Events !!', 404);
    // }
}
