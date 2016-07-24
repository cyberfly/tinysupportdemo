@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Submit New Ticket</div>

                    <div class="panel-body">

                        {!! Form::open(['route' => 'helpdesk.tickets.store','class' => 'form-horizontal', 'files' => true]) !!}

                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : false }}">

                            <label class="col-sm-2 control-label">Behalf of Customer <span class="symbol required"> * </span> </label>
                            <div class="col-sm-4">
                                {!! Form::select('user_id',$customers,'',['class'=>'form-control']) !!}
                                <p class="text-danger">{{ $errors->first('user_id') }}</p>
                            </div>

                        </div>

                        @include('tickets.partials.create_fields')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

