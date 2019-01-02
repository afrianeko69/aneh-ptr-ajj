<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Jobs\RegisterNewsletterEmailToSendGrid;
use App\Newsletter;
use Illuminate\Http\Request;
use URL;

class NewsletterController extends Controller
{
    /**
     * Store a newly created resource in newsletter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Requests\CreateNewsletterRequest $request)
    {
        $data = $request->all();
        $data['submitted_url'] = URL::previous();

        $already_registered = Newsletter::where('email', $data['email'])->first();
        if($already_registered) {
            if($already_registered->is_registered_to_sendgrid) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Anda sudah pernah mendaftar Newsletter Kami.',
                ], 400);
            } else {
                $already_registered->is_registered_to_sendgrid = 1;
                $already_registered->save();
                dispatch(new RegisterNewsletterEmailToSendGrid($already_registered));

                return response()->json([
                    'status' => 200,
                    'message' => 'Anda telah terdaftar berlangganan pada Newsletter kami.',
                ], 200);
            }
        }

        $data['is_registered_to_sendgrid'] = 1;
        $create_newsletter = Newsletter::create($data);
        dispatch(new RegisterNewsletterEmailToSendGrid($create_newsletter));
        return response()->json([
                'status' => 200,
                'message' => 'Anda telah terdaftar berlangganan pada Newsletter kami.',
            ], 200);
    }
}
