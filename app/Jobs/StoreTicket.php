<?php

namespace App\Jobs;


use App\Events\TicketCreated;
use App\Http\Requests\Request;
use App\Jobs\Job;
use App\Ticket;
use App\TicketAttachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class StoreTicket extends Job
{
    use SerializesModels;

    protected $request;
    protected $on_user_behalf;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request,$on_user_behalf='N')
    {
        $this->request = $request;
        $this->on_user_behalf = $on_user_behalf;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $input_data = $this->request->all();
        $input_data['status_id'] = 1;

        //if helpdesk submit on behalf of user

        if ($this->on_user_behalf=='Y')
        {
            $input_data['user_id'] = $this->request->user_id;
        }
        else //else user submit the ticket
        {
            $input_data['user_id'] = Auth::user()->id;
        }

        $ticket = Ticket::create($input_data);

        //perform upload file if has input

        if ($this->request->hasFile('file_attachment') && $this->request->file('file_attachment')->isValid()) {

            //rename file to make it unique
            $fileName = $ticket->id.'-'.$this->request->file('file_attachment')->getClientOriginalName();

            //set destination path
            $destinationPath = base_path() . '/public/uploads/';

            //pindah upload gambar ke destination baru
            $this->request->file('file_attachment')->move($destinationPath, $fileName);

            $ticket_attachment = new TicketAttachment();
            $ticket_attachment->attachment_filename = $fileName;
            //save polymorphism
            $ticket->attachments()->save($ticket_attachment);

        }

        Event::fire(new TicketCreated($ticket));
    }
}
