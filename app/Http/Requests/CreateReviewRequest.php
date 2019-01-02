<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
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
            'rating' => 'required|numeric|min:1|max:5|integer',
            'review' => 'required'
        ];
    }

    public function messages() {
        return [
            'rating.required' => 'Kolom rating harus diisi.',
            'rating.numeric' => 'Kolom rating harus dalam format angka',
            'rating.min' => 'Kolom rating minimal :min',
            'rating.max' => 'Kolom rating maksimal :max',
            'rating.integer' => 'Kolom rating harus angka bulat',
            'review.required' => 'Kolom ulasan harus diisi'
        ];
    }
}
