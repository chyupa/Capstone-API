<?php

namespace App\Http\Requests;

use App\Profile\Model\Profile;

class RateRequest extends Request
{
    public function authorize()
    {
        $userId = $this->route('userId');

        return Profile::where('id', $userId)
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function rules()
    {
        return [
            "rate" => "required|numeric"
        ];
    }
}