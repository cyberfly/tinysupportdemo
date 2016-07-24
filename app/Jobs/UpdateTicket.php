<?php

namespace App\Jobs;


use App\Events\TicketUpdated;
use App\Http\Requests\Request;
use App\Jobs\Job;
use App\Ticket;
use App\TicketAttachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class UpdateTicket extends Job
{
    use SerializesModels;

    protected $request;
    protected $ticket_id;
    protected $on_user_behalf;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request,$ticket_id,$on_user_behalf='N')
    {
        $this->request = $request;
        $this->ticket_id = $ticket_id;
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

        //if helpdesk submit on behalf of user

        if ($this->on_user_behalf=='Y')
        {
            $input_data['user_id'] = $this->request->user_id;
        }

        $ticket = Ticket::findOrFail($this->ticket_id);
        $ticket->update($input_data);

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

        Event::fire(new TicketUpdated($ticket));
    }
}
