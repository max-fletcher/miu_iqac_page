<?php

namespace App\Http\Controllers;

// use App\Events\NewContactUsWasSubmittedEvent;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index(){
        return response()->json(ContactUs::all(), 200);
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email'],
            'message' => ['required', 'string'],
        ]);

        $mail_data = ContactUs::Create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // This needs terminal in the server to run php artisan queue:work so its not gonna work for MIU server
        // event(new NewContactUsWasSubmittedEvent($mail_data));

        // Send Mail To Admin
        Mail::to("amar.naam.machine@gmail.com")->send(new ContactUsMail($mail_data));

        return response()->json("Mail Sent Successfully !!", 201);
    }

    public function show($id){

        $contact_us = ContactUs::find($id);
        if($contact_us){
            return response()->json($contact_us, 200);
        }

        return response()->json("The Provided ID doesn't match any Contact Us Records !!", 404);
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email'],
            'message' => ['required', 'string'],
        ]);

        $contact_us = ContactUs::find($id);
        if($contact_us){
            $contact_us->name = $request->name;
            $contact_us->email = $request->email;
            $contact_us->message = $request->message;
            $contact_us->save();

            // Resend Mail
            $mail_data = $contact_us;
            Mail::to("amar.naam.machine@gmail.com")->send(new ContactUsMail($mail_data));
            
            return response()->json("Contact Us Updated Successfully !!", 201);
        }

        return response()->json("The Provided ID doesn't match any Contact Us Records !!", 404);
    }

    public function destroy($id){

        $contact_us = ContactUs::find($id);
        if($contact_us){            
            $contact_us->delete();
            return response()->json("Contact Us Deleted Successfully !!", 201);
        }

        return response()->json("The Provided ID doesn't match any Contact Us Records !!", 404);
    }
}
