<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendReferralRequest extends FormRequest
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
            'email' => 'email|required',
            'name' => 'required',
            'redirect_to' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama harus diisi.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Kolom email harus dalam format email yang benar.',
            'redirect_to.required' => 'Kolom redirect to harus diisi',
        ];
    }
}
