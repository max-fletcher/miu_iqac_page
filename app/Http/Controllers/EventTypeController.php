<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventType;

class EventTypeController extends Controller
{
    public function index()
    {
        return response()->json( EventType::all(), 200);
    }

    public function frontend_index()
    {
        $all_event_types = EventType::select('id', 'event_type')->get();
        return response()->json( $all_event_types, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_type' => ['required', 'string', 'max:255', 'unique:event_types']
        ]);

        EventType::Create([
            'event_type' => $request->event_type
        ]);

        return response()->json( 'Event Type Successfully Added !!' , 201);
    }

    public function show($id)
    {
        $event_type = EventType::find($id);
        if($event_type){
            return response()->json($event_type, 200);
        }

        return response()->json('Event Type Not Found !!', 404);
    }
        

    public function update(Request $request, $id)
    {
        $request->validate([
            'event_type' => ['required', 'string', 'max:255', 'unique:event_types']
        ]);

        $event_type = EventType::find($id);

        if($event_type){
            $event_type->event_type = $request->event_type;
            $event_type->save();
    
            return response()->json('Event Type Updated Successfully', 201);
        }

        return response()->json('Event Type With ID Not Found !!', 404);
    }

    public function destroy($id)
    {
        $event_type = EventType::find($id);

        if($event_type){        
            $event_type->delete();
    
            return response()->json('Event Type Deleted Successfully', 201);
        }

        return response()->json('Event Type With ID Not Found !!', 404);
    }
}
