<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\APIRequest;

class ForgetPasswordFormRequest extends APIRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|numeric|exists:users,phone|digits:11|regex:/(01)[0-9]{9}/',
        ];
    }

    public function attributes()
    {
        return [
            'phone' => trans('admin.phone'),
        ];
    }
}
