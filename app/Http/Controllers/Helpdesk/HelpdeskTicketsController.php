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
use App\Jobs\StoreComment;
use App\Jobs\StoreTicket;
use App\Jobs\UpdateTicket;
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
        $pending_count = Ticket::where('helpdesk_user_id',Auth::user()->id)->where('status_id','1')->count();
        $open_count = Ticket::where('helpdesk_user_id',Auth::user()->id)->where('status_id','2')->count();
        $solved_count = Ticket::where('helpdesk_user_id',Auth::user()->id)->where('status_id','3')->count();

        $tickets = Ticket::with('category','priority','lastResponse')->where('helpdesk_user_id',Auth::user()->id);

        if (!empty($this->request->status))
        {
            $tickets = $tickets->whereStatusId($this->request->status);
        }

        $tickets = $tickets->orderBy('id','desc')->paginate(10);

        return view('helpdesk.tickets.index',compact('tickets','pending_count','open_count','solved_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategoriesSelect();
        $priorities = $this->getPrioritiesSelect();
        $customers = $this->getCustomersSelect();
        
        return view('helpdesk.tickets.create',compact('categories','priorities','customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTicketRequest $request)
    {
        $this->dispatch(new StoreTicket($request,$on_user_behalf='Y'));

        flash('Your ticket was successfully submitted','success');

        return redirect(route('helpdesk.tickets.index'));
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
        return view('helpdesk.tickets.show',compact('ticket','ticket_responses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->getCategoriesSelect();
        $priorities = $this->getPrioritiesSelect();

        $ticket = Ticket::findOrFail($id);

        return view('helpdesk.tickets.edit',compact('ticket','categories','priorities'));
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
        $this->dispatch(new UpdateTicket($request,$id));

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
        $this->dispatch(new StoreComment($request,$id));

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
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        flash('The ticket has been succesfully deleted','success');

        return back();
    }

    private function getTicketResponses($id)
    {
        $ticket_responses = Ticket::find($id)->responses;
        return $ticket_responses;
    }
}
