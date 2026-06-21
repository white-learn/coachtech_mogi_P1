<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'item_name' => ['required'],
            'item_plain' => ['required', 'max:255'],
            'item_photo' => ['required', 'mimes:jpeg,png'],
            'categories' => ['required'],
            'condition_id' => ['required'],
            'value' => ['required', 'integer', 'min:0'],
        ];
    }
}