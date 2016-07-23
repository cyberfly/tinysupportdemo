<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function helpdesk_users()
    {
        return $this->belongsToMany('App\User','helpdesk_category');
    }
}
