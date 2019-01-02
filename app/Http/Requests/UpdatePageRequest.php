<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Page;
use Auth;
class UpdatePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $page = Page::where('id',$this->route('page'))->first();
        return ($page->affiliate_id != Auth::user()->affiliate_id) ? false : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required'
        ];
    }
}
