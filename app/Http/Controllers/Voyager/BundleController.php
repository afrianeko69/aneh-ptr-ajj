<?php

namespace App\Http\Controllers\Voyager;

use Carbon\Carbon;

class BundleController extends Controller
{
    public function insertUpdateData($request, $slug, $rows, $data) {
        $form_data = $request->except('_token', '_method');
        $multiple_data = [
            'products', 'product_sort'
        ];
        $dates = [
            'start_at',
            'end_at'
        ];

        foreach($form_data as $index => $form) {
            if(!in_array($index, $multiple_data)) {
                if(in_array($index, $dates)) {
                    $data->{$index} = (!empty($form) ? Carbon::parse($form) : null);
                } else {
                    $data->{$index} = $form;
                }
            }
        }

        $data->save();

        if(isset($form_data['products'])) {
            foreach($form_data['products'] as $k => $i) {
                if(!empty($i)) {
                    $multiple_data['products'][$i] = [
                        'sort' => (!empty($form_data['product_sort'][$k]) ? $form_data['product_sort'][$k] : null),
                    ];
                }
            }
            $data->products()->sync($multiple_data['products']);
        };

        return $data;
    }
}
