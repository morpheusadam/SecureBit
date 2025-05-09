<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => [
                'required',
                'string',
                'max:30',
                'unique:users,username',
                'regex:/^[a-zA-Z0-9_\-]+$/'
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'unique:users,email'
            ],
            'full_name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\p{L}\s\-]+$/u'
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'terms' => ['required', 'accepted']
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'نام کاربری الزامی است.',
            'username.unique' => 'این نام کاربری قبلا ثبت شده است.',
            'username.regex' => 'نام کاربری فقط می‌تواند شامل حروف، اعداد، خط تیره و زیرخط باشد.',
            
            'email.required' => 'ایمیل الزامی است.',
            'email.email' => 'ایمیل معتبر نیست.',
            'email.unique' => 'این ایمیل قبلا ثبت شده است.',
            
            'full_name.required' => 'نام کامل الزامی است.',
            'full_name.regex' => 'نام کامل فقط می‌تواند شامل حروف و فاصله باشد.',
            
            'password.required' => 'رمز عبور الزامی است.',
            'password.confirmed' => 'تکرار رمز عبور مطابقت ندارد.',
            'password.min' => 'رمز عبور باید حداقل 8 کاراکتر باشد.',
            
            'terms.required' => 'پذیرش قوانین الزامی است.',
            'terms.accepted' => 'شما باید قوانین را بپذیرید.'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'username' => strtolower(trim($this->username)),
            'email' => strtolower(trim($this->email)),
            'full_name' => preg_replace('/\s+/', ' ', trim($this->full_name))
        ]);
    }
}