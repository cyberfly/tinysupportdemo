<?php

namespace App\Listeners;

use App\Category;
use App\Events\TicketCreated;
use App\Ticket;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignHelpdesk implements ShouldQueue
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

        $category_id = $ticket->category_id;

        //get all the helpdesk in specific category

        $helpdesk_category_users = Category::find($category_id)->helpdesk_users;

        //choose the helpdesk with the least job in hand

        $assign_helpdesk_id = 0;
        $lowest_count = 0;

        $count = 0;

        foreach ($helpdesk_category_users as $user) {

            $helpdesk_open_ticket_count = Ticket::where('helpdesk_user_id',$user->id)->where('status_id','!=',3)->count();

            if (empty($count))
            {
                $lowest_count = $helpdesk_open_ticket_count;
                $assign_helpdesk_id = $user->id;
            }
            else
            {
                if ($helpdesk_open_ticket_count<$lowest_count)
                {
                    $lowest_count = $helpdesk_open_ticket_count;
                    $assign_helpdesk_id = $user->id;
                }
            }

            $count++;
        }

        if (!empty($assign_helpdesk_id))
        {
            $ticket->helpdesk_user_id = $assign_helpdesk_id;
            $ticket->save();
        }
    }
}
