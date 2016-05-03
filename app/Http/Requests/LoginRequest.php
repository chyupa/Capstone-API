<?php
/**
 * Created by PhpStorm.
 * User: Razvan
 * Date: 03-May-16
 * Time: 09:50 PM
 */

namespace App\Http\Requests;

class LoginRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "email" => "required",
            "password" => "required"
        ];
    }
}