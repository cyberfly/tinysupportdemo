<?php

// Code within app\Helpers\ViewHelper.php

namespace App\Helpers;

class ViewHelper
{
    public static function showCommentBox($ticket,$response)
    {
        $commentBox = '';

        if($response->user_id!=$ticket->user_id) //support reply
        {
            $commentBox = '
            
                    <article class="row">
                        <div class="col-md-10 col-sm-10">
                            <div class="panel panel-default arrow right">
                                <div class="panel-body">
                                    <header class="text-right">
                                        <div class="comment-user"><i class="fa fa-user"></i> '.$response->user->name.'</div>
                                        <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> '.$response->created_at->format('d/m/Y H:i:A').'</time>
                                    </header>
                                    <div class="comment-post">
                                        '.$response->response_description.'
                                    </div>
                                    <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 hidden-xs">
                            <figure class="thumbnail">
                                <img class="img-responsive" src="'.url('images/avatar.jpg').'" />
                                <figcaption class="text-center">username</figcaption>
                            </figure>
                        </div>
                    </article>';
        }
        else //your reply
        {
            $commentBox = '
                    <article class="row">
                        <div class="col-md-2 col-sm-2 hidden-xs">
                            <figure class="thumbnail">
                                <img class="img-responsive" src="'.url('images/avatar.jpg').'" />
                                <figcaption class="text-center">'.$response->user->name.'</figcaption>
                            </figure>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <div class="panel panel-default arrow left">
                                <div class="panel-body">
                                    <header class="text-left">
                                        <div class="comment-user"><i class="fa fa-user"></i> '.$response->user->name.'</div>
                                        <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> '.$response->created_at->format('d/m/Y H:i:A').'</time>
                                    </header>
                                    <div class="comment-post">
                                        '.$response->response_description.'
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </article>';
        }

        return $commentBox;
    }
}