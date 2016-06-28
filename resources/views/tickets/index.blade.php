@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Ticket List</div>

                    <div class="panel-body">

                        <p>
                            <a href="{!! route('tickets.create') !!}" class="btn btn-primary">New Ticket</a>
                        </p>

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Title</td>
                                <td>Ticket Status</td>
                                <td>Priority</td>
                                <td>Category</td>
                                <td>Response</td>
                                <td>Last Response by</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($tickets as $ticket)

                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>
                                        <a href="{!! route('tickets.show',$ticket->id); !!}">{{ $ticket->ticket_subject }}</a>
                                    </td>
                                    <td>
                                        {!! $ticket->status_label !!}
                                    </td>
                                    <td>{{ $ticket->priority->priority_name }}</td>
                                    <td>{{ $ticket->category->category_name }}</td>
                                    <td>
                                        <a href="{!! route('tickets.show',$ticket->id); !!}" class="btn btn-info btn-xs" >Response <span class="badge">{{ $ticket->responses->count() }}</span></a>
                                    </td>
                                    <td>
                                        {{ $ticket->lastResponse->user->name or '-'  }}
                                        <br>
                                        {{ $ticket->lastResponse->time_ago or '' }}
                                    </td>
                                    <td>
                                        <a href="{!! route('tickets.show',$ticket->id) !!}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span></a>

                                        @if($ticket->status_id==1)
                                            <a href="{!! route('tickets.edit',$ticket->id) !!}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        @endif
                                    </td>
                                    {{--<td>{{ $ticket->last_response_by->user_id or '-' }}</td>--}}
                                    {{--<td>{{ $ticket->responses->last()  }}</td>--}}
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

