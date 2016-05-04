<?php

namespace App\Http\Requests;

use App\Capstone\Profile\Model\Profile;

class PostcodeRequest extends Request
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
            "postcode" => [
                'required',
                'regex:/^(([gG][iI][rR] {0,}0[aA]{2})|((([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y]?[0-9][0-9]?)|(([a-pr-uwyzA-PR-UWYZ][0-9][a-hjkstuwA-HJKSTUW])|([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y][0-9][abehmnprv-yABEHMNPRV-Y]))) {0,}[0-9][abd-hjlnp-uw-zABD-HJLNP-UW-Z]{2}))$/'
            ]
        ];
    }
}