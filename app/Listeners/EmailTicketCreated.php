<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailTicketCreated implements ShouldQueue
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
     * @param  TicketCreated  $event
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        $ticket = $event->ticket;

        $helpdesk_user_id = $ticket->helpdesk_user_id;
        $user = User::findOrFail($helpdesk_user_id);

        //send the email to helpdesk

        Mail::queue('emails.tickets.helpdesk_new_ticket_alert', ['ticket' => $ticket,'user' => $user], function ($m) use ($ticket,$user) {

            $m->from('system@tinysupport.dev', 'TinySupport System');

            $m->to($user->email, $user->name)->subject('New Ticket was assigned to you');
        });
    }
}
