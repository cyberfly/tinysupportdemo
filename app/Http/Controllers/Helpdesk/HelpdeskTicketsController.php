<?php

namespace App\Http\Controllers\Helpdesk;
use App\Http\Controllers\Controller;

use App\Category;
use App\Events\TicketCreated;
use App\Events\TicketResponseCreated;
use App\Events\TicketUpdated;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\EditTicketRequest;
use App\Http\Traits\DynamicSelect;
use App\Priority;
use App\Ticket;
use App\TicketAttachment;
use App\TicketResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;


class HelpdeskTicketsController extends Controller
{
    use DynamicSelect;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $tickets = Ticket::with('category','priority','lastResponse');
//        $tickets = Ticket::with('category','priority','lastResponse')->orderBy('id','desc')->paginate(10);
        $pending_count = Auth::user()->tickets()->where('status_id','1')->count();
        $open_count = Auth::user()->tickets()->where('status_id','2')->count();
        $solved_count = Auth::user()->tickets()->where('status_id','3')->count();

        $tickets = Auth::user()->tickets()->with('category','priority','lastResponse');

        if (!empty($this->request->status))
        {
//            dd($this->request->status);
            $tickets = $tickets->whereStatusId($this->request->status);
        }

        $tickets = $tickets->orderBy('id','desc')->paginate(10);

        return view('tickets.index',compact('tickets','pending_count','open_count','solved_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $categories = Category::lists('category_name','id');
//        $categories = [''=>'Select Category'] + $categories->all();
//        $priorities = Priority::lists('priority_name','id');

        $categories = $this->getCategories();
        $priorities = $this->getCategories();
        
        return view('tickets.create',compact('categories','priorities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTicketRequest $request)
    {
        $input_data = $request->all();
        $input_data['status_id'] = 1;
        $input_data['user_id'] = Auth::user()->id;
        $ticket = Ticket::create($input_data);

        //perform upload file if has input

        if ($request->hasFile('file_attachment') && $request->file('file_attachment')->isValid()) {

            //rename file to make it unique
            $fileName = $ticket->id.'-'.$request->file('file_attachment')->getClientOriginalName();

            //set destination path
            $destinationPath = base_path() . '/public/uploads/';

            //pindah upload gambar ke destination baru
            $request->file('file_attachment')->move($destinationPath, $fileName);
            $ticket_attachment = new TicketAttachment();
            $ticket_attachment->attachment_filename = $fileName;
            //save polymorphism
            $ticket->attachments()->save($ticket_attachment);

        }

        //save activity log

        //send email

        Event::fire(new TicketCreated($ticket));
        
        flash('Your ticket was successfully submitted','success');

        return redirect(route('tickets.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        $ticket_responses = $this->getTicketResponses($id);
        return view('tickets.show',compact('ticket','ticket_responses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $categories = Category::lists('category_name','id');
//        $categories = [''=>'Select Category'] + $categories->all();
//        $priorities = Priority::lists('priority_name','id');

        $categories = $this->getCategories();
        $priorities = $this->getCategories();

        $ticket = Ticket::findOrFail($id);

        return view('tickets.edit',compact('ticket','categories','priorities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditTicketRequest $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());
//        $ticket->fill($request->all());
//        $ticket->save();

        //perform upload file if has input

        if ($request->hasFile('file_attachment') && $request->file('file_attachment')->isValid()) {

            //rename file to make it unique
            $fileName = $ticket->id.'-'.$request->file('file_attachment')->getClientOriginalName();

            //set destination path
            $destinationPath = base_path() . '/public/uploads/';

            //pindah upload gambar ke destination baru
            $request->file('file_attachment')->move($destinationPath, $fileName);
            $ticket_attachment = new TicketAttachment();
            $ticket_attachment->attachment_filename = $fileName;
            //save polymorphism
            $ticket->attachments()->save($ticket_attachment);

        }

        //save activity log

        //send email

        Event::fire(new TicketUpdated($ticket));

        flash('Your ticket was successfully updated','success');

        return back();
    }

    /**
     * Store the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeComment(CreateCommentRequest $request, $id)
    {
        $ticketResponse = new TicketResponse;
        $ticketResponse->response_description = $request->response_description;
        $ticketResponse->ticket_id = $id;
        $ticketResponse->status_id = 1;
        Auth::user()->ticketResponses()->save($ticketResponse);

        Event::fire(new TicketResponseCreated($ticket));

        flash('Your response was successfully submitted','success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getTicketResponses($id)
    {
        $ticket_responses = Ticket::find($id)->responses;
        return $ticket_responses;
    }
}
