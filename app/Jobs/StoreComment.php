<?php

namespace App\Jobs;

use App\Events\TicketResponseCreated;
use App\Jobs\Job;
use App\TicketResponse;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class StoreComment extends Job
{
    use SerializesModels;

    protected $request;
    protected $ticket_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request,$ticket_id)
    {
        $this->request = $request;
        $this->ticket_id = $ticket_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ticketResponse = new TicketResponse;
        $ticketResponse->response_description = $this->request->response_description;
        $ticketResponse->ticket_id = $this->ticket_id;
        $ticketResponse->status_id = 1;

        Auth::user()->ticketResponses()->save($ticketResponse);

        Event::fire(new TicketResponseCreated($ticketResponse));
    }
}
