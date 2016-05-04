<?php

namespace App\Http\Requests;

class SearchPostcodesRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'postcode' => [
                'required',
            ]
        ];
    }
}