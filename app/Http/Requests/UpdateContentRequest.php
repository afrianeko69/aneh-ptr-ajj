<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Content;
use Auth;
class UpdateContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $content = Content::where('id',$this->route('content'))->first();
        return ($content->affiliate_id != Auth::user()->affiliate_id) ? false : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
