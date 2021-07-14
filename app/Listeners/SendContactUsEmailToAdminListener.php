<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
Use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;

class SendContactUsEmailToAdminListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to("amar.naam.machine@gmail.com")->send(new ContactUsMail($event->mail_data));
    }
}
