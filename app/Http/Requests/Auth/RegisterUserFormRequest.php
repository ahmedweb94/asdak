<?php

namespace App\Http\Requests\Auth;

use App\Helper\General;
use App\Http\Requests\APIRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserFormRequest extends APIRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:100|min:3',
            'username' => 'required|string|max:100|min:3|unique:users,username',
            'email' => ['required', 'min:6', 'email', 'unique:users,email'],
            'phone' => ['required', 'digits:11', 'regex:/(01)[0-9]{9}/', 'unique:users,phone'],
            'password' => ['required', 'string', 'max:32', 'confirmed'
                , Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
//                ->uncompromised()
                ],
            'address' => 'required|string|max:100|min:3',
            'age' => 'required|numeric|int',
            'short_description' => 'required|string|min:3|max:250',
            'education_degree' => 'required|string|min:3|max:100',
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
            'phone' => trans('admin.phone'),
            'password' => trans('admin.password'),
            'name' => trans('admin.name'),
            'username' => trans('admin.username'),
            'email' => trans('admin.email'),
            'age' => trans('admin.age'),
            'address' => trans('admin.address'),
            'short_description' => trans('admin.short_description'),
            'education_degree' => trans('admin.education_degree'),
        ];
    }
}
