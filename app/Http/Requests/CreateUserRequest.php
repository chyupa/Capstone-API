<?php
/**
 * Created by PhpStorm.
 * User: Razvan
 * Date: 03-May-16
 * Time: 09:21 PM
 */

namespace App\Http\Requests;


class CreateUserRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
            "name" => "required"
        ];
    }
}