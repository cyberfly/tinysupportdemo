@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">Submit New Ticket</div>

                    <div class="panel-body">

                        {!! Form::open(['route' => 'tickets.store','class' => 'form-horizontal', 'files' => true]) !!}

                        <div class="form-group {{ $errors->has('ticket_subject') ? 'has-error' : false }}">

                            <label class="col-sm-2 control-label">Subject <span class="symbol required"> * </span> </label>
                            <div class="col-sm-10">
                                {!! Form::text('ticket_subject','',['class'=>'form-control']) !!}
                                <p class="text-danger">{{ $errors->first('ticket_subject') }}</p>
                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : false }}">

                            <label class="col-sm-2 control-label">Category <span class="symbol required"> * </span> </label>
                            <div class="col-sm-10">
                                {!! Form::select('category_id',$categories,'',['class'=>'form-control']) !!}
                                <p class="text-danger">{{ $errors->first('category_id') }}</p>
                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('ticket_description') ? 'has-error' : false }}">

                            <label class="col-sm-2 control-label">Description <span class="symbol required"> * </span> </label>
                            <div class="col-sm-10">
                                {!! Form::textarea('ticket_description','',['class'=>'form-control']) !!}
                                <p class="text-danger">{{ $errors->first('ticket_description') }}</p>
                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('file_attachment') ? 'has-error' : false }}">

                            <label class="col-sm-2 control-label">File Attachment</label>
                            <div class="col-sm-10">
                                {!! Form::file('file_attachment') !!}
                                <p class="text-danger">{{ $errors->first('file_attachment') }}</p>
                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('priority_id') ? 'has-error' : false }}">

                            <label class="col-sm-2 control-label">Priority <span class="symbol required"> * </span> </label>
                            <div class="col-sm-10">
                                {!! Form::select('priority_id',$priorities,'',['class'=>'form-control']) !!}
                                <p class="text-danger">{{ $errors->first('priority_id') }}</p>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-push-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{!! route('tickets.index') !!}" class="btn btn-default">Back</a>
                            </div>

                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

