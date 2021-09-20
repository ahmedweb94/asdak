<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\APIRequest;

class LoginUserFormRequest extends APIRequest
{
    public function rules()
    {
        return [
            'password' => 'required|string',
            'phone' => 'required|digits:11|regex:/(01)[0-9]{9}/',
        ];
    }

    public function attributes()
    {
        return [
            'phone' => trans('admin.phone'),
            'password' => trans('admin.password'),
        ];
    }
}
