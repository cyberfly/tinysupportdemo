<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function helpdesk_manage_tickets()
    {
        return $this->hasMany('App\Ticket','helpdesk_user_id','id');
    }

    public function ticketResponses()
    {
        return $this->hasMany('App\TicketResponse','user_id','id');
    }

    public function helpdesk_categories()
    {
        return $this->belongsToMany('App\Category','helpdesk_category');
    }
}
