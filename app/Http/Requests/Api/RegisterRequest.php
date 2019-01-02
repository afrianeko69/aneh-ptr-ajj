<?php

namespace App\Http\Requests\Api;

use App\UserAccountProvider;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
        ];

        if($this->register_using == UserAccountProvider::SSO_PROVIDER){
            $rules = array_merge($rules, [
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password|min:8',
            ]);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama harus diisi.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Kolom email harus sesuai dengan format email.',
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Kolom password minimal 8 karakter.',
            'confirm_password.required' => 'Kolom konfirmasi password harus diisi.',
            'confirm_password.same' => 'Kolom konfirmasi password harus sama dengan kolom password.',
            'confirm_password.min' => 'Kolom konfirmasi password minimal 8 karakter.',
        ];
    }
}
