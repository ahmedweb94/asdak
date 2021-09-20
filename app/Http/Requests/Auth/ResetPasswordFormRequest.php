<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\APIRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordFormRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required|exists:users,phone|digits:11|regex:/(01)[0-9]{9}/',
            'code' => 'required|digits:4',
            'password' => ['required','string','max:32','confirmed',
                Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
//                ->uncompromised()
                ,]
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
        return
        [
          'password'=>trans('admin.password'),
          'phone'=>trans('admin.phone'),
          'code'=>trans('admin.code'),
        ];
    }
}
