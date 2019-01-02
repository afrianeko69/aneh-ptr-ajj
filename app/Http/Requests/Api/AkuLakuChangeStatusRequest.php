<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AkuLakuChangeStatusRequest extends FormRequest
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
        if ($this->route()->getName() == 'akulaku.change-status') {
            return [
                'refNo' => 'required|exists:orders,order_number',
                'status' => 'required|in:100,90',
            ];
        } else {
            return [
                'refNo' => 'required|exists:orders,order_number'
            ];
        }
    }
}
