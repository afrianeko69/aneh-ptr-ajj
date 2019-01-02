<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\Departement;
use Request;

class MoreInfoRequest extends FormRequest
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
            'email' => 'required|email|uniqueEmailAndProduct:'.$this->request->get('product'),
            'phone' => 'required|numeric',
            'location' => 'required',
            'product' => 'required',
            'applicant_category' => 'required',
            'number_of_applicants' => 'required_if:applicant_category,'.Departement::getApplicantCategories()[1].'|nullable|numeric|min:1',
            'interest' => 'required',
            'reference_email' => 'nullable|email',
            'g-recaptcha-response' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama harus diisi.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Kolom email harus dalam format email yang benar.',
            'email.unique_email_and_product' => 'Anda sudah pernah terdaftar pada produk ini',
            'phone.required' => 'Kolom nomor ponsel harus diisi.',
            'phone.numeric' => 'Kolom nomor ponsel harus diisi dalam format angka.',
            'location.required' => 'Kolom lokasi harus diisi.',
            'product.required' => 'Kolom produk harus diisi.',
            'applicant_category.required' => 'Kolom kategori pendaftar harus diisi.',
            'number_of_applicants.required_if' => 'Kolom Jumlah karyawan yang akan didaftarkan wajib diisi',
            'number_of_applicants.numeric' => 'Kolom Jumlah karyawan yang akan didaftarkan harus diisi dalam format angka',
            'number_of_applicants.min' => 'Kolom Jumlah karyawan yang akan didaftarkan minimal berjumlah 1',
            'interest.required' => 'Kolom rencana belajar harus diisi',
            'reference_email.email' => 'Kolom email pemberi referensi harus dalam format email yang benar.',
            'g-recaptcha-response.required' => 'Harap mencentang captcha.'
        ];
    }
}
