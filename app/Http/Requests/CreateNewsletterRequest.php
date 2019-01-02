<?php

namespace App\Http\Requests;

use App\Newsletter;
use Illuminate\Foundation\Http\FormRequest;

class CreateNewsletterRequest extends FormRequest
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
        $rules = Newsletter::$rules;
        return $rules;
    }
    
    public function messages()
    {
        return [
            'email.email' => 'Kolom email harus dalam format email yang benar.',
        ];
    }
}
