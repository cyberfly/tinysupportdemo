<?php

namespace App\Listeners;

use App\Events\TicketResponseCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailTicketResponseCreated
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
     * @param  TicketResponseCreated  $event
     * @return void
     */
    public function handle(TicketResponseCreated $event)
    {
        //
    }
}
