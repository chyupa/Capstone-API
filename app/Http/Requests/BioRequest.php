<?php

namespace App\Http\Requests;

use App\Capstone\Profile\Model\Profile;

class BioRequest extends Request
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
            "bio" => "required"
        ];
    }
}