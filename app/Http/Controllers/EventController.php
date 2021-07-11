<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return response()->json( Event::with('event_type')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_type_id' => ['required', 'numeric', 'integer', 'exists:event_types,id'],
            'event_name' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
        ]);

        Event::Create([
            'event_type_id' => $request->event_type_id,
            'event_name' => $request->event_name,
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
            'event_date' => ['required', 'date'],
        ]);

        $event = Event::find($id);
        if ($event) {
            $event->event_type_id = $request->event_type_id;
            $event->event_name = $request->event_name;
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
            $event->delete();
            return response()->json('Event Deleted Successfully !', 201);
        }

        return response()->json('The Provided ID doesn\'t match any Events !!', 404);
    }

    public function find_all_events_by_event_type_id($id)
    {        
        $events = Event::with('event_type')->where('event_type_id', $id)->get();
        return response()->json($events, 404);
    }
}
