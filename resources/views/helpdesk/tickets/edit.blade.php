@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Edit Ticket</div>

                    <div class="panel-body">

                        {!! Form::open(['route' => ['helpdesk.tickets.update',$ticket->id],'class' => 'form-horizontal', 'method'=>'PUT', 'files' => true]) !!}

                        @include('tickets.partials.edit_fields')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

