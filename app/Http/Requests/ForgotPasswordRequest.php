<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'email' => 'required|email',
            'g-recaptcha-response' => 'required',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Kolom email harus dalam format email yang benar.',
            'g-recaptcha-response.required' => 'Harap mencentang captcha.',
        ];
    }
}