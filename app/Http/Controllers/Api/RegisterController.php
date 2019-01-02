<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\User;
use Session;
use Auth;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $data = $request->all();

        if (!Session::has(config('constants.register_domain_page')) && isset($data['user_domain'])) {
            Session::put(config('constants.register_domain_page'), $data['user_domain']);
        }

        if (!Session::has(config('constants.register_previous_page')) && isset($data['user_previous_url'])){
            Session::put(config('constants.register_previous_page'), $data['user_previous_url']);
        }

        $register = User::register($data);

        return response()->json($register, $register['status']);
    }
}
