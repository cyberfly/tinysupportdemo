<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    public function attachable()
    {
        return $this->morphTo();
    }
}
