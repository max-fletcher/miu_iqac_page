<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventType;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        return response()->json( Event::with('event_type')->orderBy('created_at', 'desc')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_type_id' => ['required', 'numeric', 'integer', 'exists:event_types,id'],
            'event_name' => ['required', 'string', 'max:255'],
            'event_description' => ['required', 'string'],
            'event_image' => [ 'image', 'sometimes', 'max:2000'],
            'event_date' => ['required', 'date'],
        ]);

        if($request->hasFile('event_image')) {
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
            //upload image
            $request->file('event_image')->storeAs('public/event_images', $filenameToStore);
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
            'event_image' => [ 'image', 'sometimes', 'max:2000'],
            'event_date' => ['required', 'date'],
        ]);

        if($request->hasFile('event_image')) {
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
            //upload image
            $request->file('event_image')->storeAs('public/event_images', $filenameToStore);
        }
        else{
            $filenameToStore = 'noimage.jpg';
        }

        $event = Event::find($id);
        if ($event) {
            $event->event_type_id = $request->event_type_id;
            $event->event_name = $request->event_name;
            $event->event_description = $request->event_description;
            if($request->hasFile('event_image')){     //works if there is a new image uploaded
                Storage::delete('public/event_images/'.$event->event_image);  //deletes previous image
                //needs to use Illuminate\Support\Facades\Storage;
            }
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
            Storage::delete('public/event_images/'.$event->event_image);  //deletes image
            $event->delete();
            return response()->json('Event Deleted Successfully !', 201);
        }

        return response()->json('The Provided ID doesn\'t match any Events !!', 404);
    }

    public function upcoming_events_by_event_type_id($id)
    {        
        $event_type = EventType::find($id);
        if($event_type){
            $events = Event::with('event_type')->where('event_type_id', $id)->where('event_date', '>=', Carbon::now())->orderBy('event_date', 'desc')->get();
            return response()->json($events, 200);
        }

        return response()->json('The Provided ID doesn\'t match any Events !!', 404);
    }

    public function passed_events_by_event_type_id($id)
    {      
        $event_type = EventType::find($id);
        if($event_type){
            $events = Event::with('event_type')->where('event_type_id', $id)->where('event_date', '<', Carbon::now())->orderBy('event_date', 'desc')->get();
            return response()->json($events, 200);
        }

        return response()->json('The Provided ID doesn\'t match any Events !!', 404);
    }
}
