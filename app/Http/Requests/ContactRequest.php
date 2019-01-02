<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'last_name_contact' => 'required',
            'first_name_contact' => 'required',
            'email_contact' => 'required|email',
            'phone_contact' => 'required|numeric',
            'message_contact' => 'required',
            'g-recaptcha-response' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'first_name_contact.required' => 'Kolom nama harus diisi.',
            'last_name_contact.required' => 'Kolom nama harus diisi.',
            'email_contact.required' => 'Kolom email harus diisi.',
            'email_contact.email' => 'Kolom email harus dalam format email yang benar.',
            'phone_contact.required' => 'Kolom nomor ponsel harus diisi.',
            'phone_contact.numeric' => 'Kolom nomor ponsel harus diisi dalam format angka.',
            'message_contact.required' => 'Kolom lokasi harus diisi.',
            'g-recaptcha-response.required' => 'Harap mencentang captcha.'
        ];
    }
}
