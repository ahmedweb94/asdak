<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\APIRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordFormRequest extends APIRequest
{
    public function rules()
    {
        return [
            'old_password' => 'required|string|min:3|max:32',
            'password' => ['required','string','max:32','confirmed'
                , Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
//                ->uncompromised(),
                ],
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'password' => bcrypt($this->password),
        ]);
    }

    public function attributes()
    {
        return [
            'password'=>trans('admin.password'),
            'old_password'=>trans('admin.old_password'),
        ];
    }
}
