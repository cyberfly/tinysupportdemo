@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Submit New Ticket</div>

                    <div class="panel-body">

                        {!! Form::open(['route' => 'helpdesk.tickets.store','class' => 'form-horizontal', 'files' => true]) !!}

                        @include('tickets.partials.create_fields')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

