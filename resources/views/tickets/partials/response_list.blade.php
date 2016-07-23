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