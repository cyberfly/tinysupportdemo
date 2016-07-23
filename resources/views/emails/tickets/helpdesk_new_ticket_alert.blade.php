<p>Dear {{ $user->name }},</p>

<p>There is new Ticket that was submitted by {{ $ticket->user->name }} and has been assigned to you.</p>

<p>Below is the Ticket details:</p>

<p>
    Ticket ID : {{ $ticket->id }}
    <br>
    Date Time : {{ $ticket->created_at->format('d/m/Y H:i:A') }}
    <br>
    Subject : {{ $ticket->ticket_subject }}
    <br>
    Priority : {!! $ticket->status_label !!}
    <br>
    Description : {!! $ticket->ticket_description !!}
</p>

<p>
    Please check the system now and solved the customer problem.
</p>

<p>
    Thanks,
    <br>
    TinySupport System
</p>

