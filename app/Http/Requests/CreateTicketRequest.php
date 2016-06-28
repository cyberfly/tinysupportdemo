<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateTicketRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ticket_subject'=>'required',
            'category_id'=>'required',
            'ticket_description'=>'required',
            'file_attachment'=>'image',
            'priority_id'=>'required',
        ];
    }
}
