@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">View Ticket</div>

                    <div class="panel-body">

                        <div class="well">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p>
                                        Owner : {{ $ticket->user->name }}
                                    </p>
                                    <p>
                                        Status : {!! $ticket->status_label !!}
                                    </p>
                                    <p>
                                        Priority : {{ $ticket->priority->priority_name }}
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        Assigned To :
                                    </p>
                                    <p>
                                        Created : {{ $ticket->created_at->diffForHumans() }}
                                    </p>
                                    <p>
                                        Last Updated : {{ $ticket->lastResponse->time_ago or '' }}
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <a href="{!! route('tickets.edit',$ticket->id) !!}" class="btn btn-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit Ticket </a>
                                </div>
                            </div>
                        </div>

                        {!! Form::open(['class' => 'form-horizontal']) !!}

                        <div class="form-group">

                            {!! Form::label('ticket_subject', 'Subject', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('ticket_subject',$ticket->ticket_subject,['class'=>'form-control','readonly'=>'readonly']) !!}

                            </div>

                        </div>

                        <div class="form-group">

                            {!! Form::label('category_id', 'Category', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::text('category_id',$ticket->category->category_name,['class'=>'form-control','readonly'=>'readonly']) !!}

                            </div>
                        </div>

                        <div class="form-group">

                            {!! Form::label('ticket_description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! $ticket->ticket_description !!}
                            </div>
                        </div>

                        <div class="form-group">

                            {!! Form::label('file_attachment', 'File Attachment', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">

                                <ul>
                                @foreach($ticket->attachments as $attachment)

                                    <li><a href="{{ url('uploads/'.$attachment->attachment_filename) }}">{{ $attachment->attachment_filename }}</a></li>

                                @endforeach
                                </ul>

                            </div>
                        </div>

                        <div class="form-group ">

                            {!! Form::label('priority_id', 'Priority', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::text('priority_id',$ticket->priority->priority_name,['class'=>'form-control','readonly'=>'readonly']) !!}


                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-push-2">
                                <a href="{!! route('tickets.index') !!}" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
                            </div>

                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">New Response</h2>

                {!! Form::open(['route' => ['tickets.storeComment',$ticket->id],'class' => 'form-horizontal']) !!}

                <div class="form-group  {{ $errors->has('response_description') ? 'has-error' : false }}">

                    {!! Form::label('response_description', 'Your Response', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('response_description','',['class'=>'form-control']) !!}
                        <p class="text-danger">{{ $errors->first('response_description') }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-push-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>

                {!! Form::close() !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">Discussion</h2>
                <section class="comment-list">

                    @foreach($ticket_responses as $response)

                        {!! ViewHelper::showCommentBox($ticket,$response) !!}

                    @endforeach

                </section>
            </div>
        </div>

    </div>



@endsection

