<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
            'logo' => 'nullable|image',
            'favicon' => 'nullable|mimes:png|dimensions:max_width=160,max_height=160'
        ];
    }

    public function messages()
    {
        return [
            'logo.image' => 'Kolom logo harus dalam format jpeg, png,jpg',
            'favicon.mimes' => 'Kolom Favicon harus dalam format png',
            'favicon.dimensions' => 'Ukuran gambarnya tidak boleh lebih dari 160x160'
        ];
    }
}
