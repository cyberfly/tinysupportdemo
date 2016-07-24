<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ticket_subject','ticket_description','category_id','priority_id','status_id','user_id'];

    public function responses()
    {
        return $this->hasMany('App\TicketResponse','ticket_id','id');
    }

    public function lastResponse()
    {
        // Note: this relationship isn't actually a one-to-one but this allows Eloquent to attach a single model rather
        // than a collection
        $relation = $this->hasOne('App\TicketResponse');
        // Grab the query which will be used to get related models and reverse the order.
        // Eloquent will match the last comment to each user.
        $relation->getQuery()->orderBy('created_at', 'desc');
        // Return relation as normal
        return $relation;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function helpdesk_user()
    {
        return $this->belongsTo('App\User','helpdesk_user_id','id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function priority()
    {
        return $this->belongsTo('App\Priority');
    }

    public function attachments()
    {
        return $this->morphMany('App\TicketAttachment', 'attachable');
    }

    public function getLastResponseByAttribute() {
        return $this->responses()->orderBy('id', 'asc')->first();
    }

    public function getStatusLabelAttribute()
    {
        switch ($this->status_id)
        {
            case '1':
                return '<span class="label label-warning">Pending</span>';
                break;

            case '2':
                return '<span class="label label-primary">Open</span>';
                break;

            case '3':
                return '<span class="label label-info">Solved</span>';
                break;

            case '4':
                return '<span class="label label-success">Closed</span>';
                break;

            default:
                return $this->status_id;
        }

    }

    public function test()
    {
        return strtoupper($this->ticket_description);
    }
}
