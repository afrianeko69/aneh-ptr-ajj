<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
        $rules = ['slug' => 'required', 'payment_method' => 'required|in:midtrans,akulaku'];
        $request = $this->request->all();

        if($request['type'] == 'paid'){
            $rules = array_merge($rules, [
                'phone_number' => 'required|numeric'
            ]);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'slug.required' => 'Slug dibutuhkan untuk memproses pembelian anda.',
            'phone_number.required' => 'Kolom nomor ponsel harus diisi.'
        ];
    }
}
