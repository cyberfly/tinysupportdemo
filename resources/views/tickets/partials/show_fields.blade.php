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