<?php

namespace App\Listeners;

use App\Events\TicketUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailTicketUpdated
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
     * @param  TicketUpdated  $event
     * @return void
     */
    public function handle(TicketUpdated $event)
    {
        //
    }
}
