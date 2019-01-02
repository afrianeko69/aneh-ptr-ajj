<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactCollegeRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|uniqueEmailAndDepartment:'.$this->request->get('departement'),
            'phone' => 'required|between:9,13|regex:/^[0-9-+()]*$/',
            'location' => 'required',
            'departement' => 'required',
            'education' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama harus diisi.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Kolom email harus dalam format email yang benar.',
            'email.unique_email_and_department' => 'Anda sudah pernah terdaftar pada jurusan ini',
            'phone.required' => 'Kolom nomor ponsel harus diisi.',
            'phone.regex' => 'Kolom nomor ponsel invalid.',
            'location.required' => 'Kolom lokasi harus diisi.',
            'departement.required' => 'Kolom jurusan harus diisi.',
            'education.required' => 'Kolom ijazah terakhir harus diisi.'
        ];
    }
}
