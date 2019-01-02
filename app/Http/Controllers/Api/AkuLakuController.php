<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AkuLakuChangeStatusRequest;
use App\Services\AkuLaku;
use App\Http\Controllers\Controller;

class AkuLakuController extends Controller
{
    public function changeStatus(AkuLakuChangeStatusRequest $request)
    {
        $akulaku = new AkuLaku();
        $response = $akulaku->setCredentials(config('services.akulaku.app_id'), config('services.akulaku.secret_key'))
            ->changeStatus($request->all());

        return response()->json($response);
    }

    public function inquiryStatus(AkuLakuChangeStatusRequest $request)
    {
        $akulaku = new AkuLaku();
        $response = $akulaku->setCredentials(config('services.akulaku.app_id'), config('services.akulaku.secret_key'))
            ->inquiryStatus($request->get('refNo'));

        return response()->json($response);
    }
}
