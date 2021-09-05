<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventType;

class EventTypeController extends Controller
{
    public function index()
    {
        $event_types = EventType::select('id', 'event_type', 'created_at')->get();
        return response()->json( $event_types , 200);
    }

    // public function frontend_index()
    // {
    //     $all_event_types = EventType::select('id', 'event_type')->get();
    //     return response()->json( $all_event_types, 200);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'event_type' => ['required', 'string', 'max:255', 'unique:event_types']
        ]);

        EventType::Create([
            'event_type' => $request->event_type
        ]);

        return response()->json( 'Event Type Added Successfully !!' , 201);
    }

    public function show($id)
    {
        $event_type = EventType::where('id', $id)->select('id', 'event_type', 'created_at')->first();
        if($event_type){
            return response()->json($event_type, 200);
        }

        return response()->json('Event Type Not Found !!', 404);
    }

    public function show_with_events($id)
    {
        $event_type = EventType::where('id', $id)->select('id', 'event_type', 'created_at')->with([
            'events' => function($query) {
                return $query->select(['id', 'event_type_id', 'event_name', 'event_description', 'event_image', 'event_date', 'created_at']);
        }])->first();
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
    
            return response()->json('Event Type Updated Successfully !!', 201);
        }

        return response()->json('Event Type With ID Not Found !!', 404);
    }

    public function destroy($id)
    {
        $event_type = EventType::find($id);

        if($event_type){        
            $event_type->delete();
    
            return response()->json('Event Type Deleted Successfully !!', 201);
        }

        return response()->json('Event Type With ID Not Found !!', 404);
    }

    public function show_sorted($id)
    {   
        $event_type = EventType::where('id', $id)->select('id', 'event_type', 'created_at')->with([
        'passed_events' => function($query) {
            return $query->select(['id', 'event_type_id', 'event_name', 'event_description', 'event_image', 'created_at']);
        },
        'upcoming_events' => function($query) {
            return $query->select(['id', 'event_type_id', 'event_name', 'event_description', 'event_image', 'created_at']);
        }])->first();
        
        if($event_type){
            return response()->json($event_type, 200);
        }

        return response()->json('Event Type Not Found !!', 404);
    }
}
