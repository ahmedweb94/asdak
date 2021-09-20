<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\APIRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends APIRequest
{
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:100|min:3',
            'username' => ['nullable', 'string', 'max:100', 'min:3', Rule::unique('users', 'username')->ignore(auth()->id())],
            'email' => ['nullable', 'min:6', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],
            'phone' => ['nullable', 'digits:11', 'regex:/(01)[0-9]{9}/', Rule::unique('users', 'phone')->ignore(auth()->id())],
            'address' => 'nullable|string|max:100|min:3',
            'age' => 'nullable|numeric|int',
            'short_description' => 'nullable|string|min:3|max:250',
            'education_degree' => 'nullable|string|min:3|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'phone' => trans('admin.phone'),
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
