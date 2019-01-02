<?php

namespace App\Listeners;

use App\Events\DaftarSayaBerminatEvent;
use App\UserReferralCode;
use GuzzleHttp\Client;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DaftarSayaBerminatEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  DaftarSayaBerminatEvent  $event
     * @return void
     */
    public function handle(DaftarSayaBerminatEvent $event)
    {
        $student_lead = $event->student_lead;

        $client = new Client();
        $response = $client->post(config('services.barantum.login_url'),[
            'json' => [
                'email' => "Rendy@harukaedu.com",
                'password' => 'demo'
            ]
        ]);

        $body = json_decode((string) $response->getBody());
        $token = $body->result;

        
        if (!empty($student_lead->referral_code)){
            $referalCode = UserReferralCode::where('referral_code', $student_lead->referral_code)->first();
        }

        $data['data'] = [
            'leads_email' => $student_lead->email,
            'leads_last_name' => $student_lead->name,
            'leads_source' => 'Pintaria',
            'leads_phone_mobile' => $student_lead->phone,
            'leads_phone_work' => $student_lead->phone,
            'leads_status' => 'New',
            'leads_address_city' => $student_lead->location
        ];

        $data['data_custom'] = [
            'leads_submission_time' => $student_lead->getUserTimezone('created_at', 'H:i:s'),
            'leads_submission_date' => $student_lead->getUserTimezone('created_at', 'Y-m-d'),
            'leads_interest' => $student_lead->product,
            'leads_time_to_enroll' => $student_lead->interest,
            'leads_page_url' => $student_lead->url,
            'leads_applicant_category' => $student_lead->applicant_category,
            'leads_number_of_applicants' => $student_lead->number_of_applicants,
            'leads_referral_code' => $student_lead->referral_code,
            'leads_promo_name' => !empty($referalCode->user->name) ? $referalCode->user->name : '',
            'leads_promo_email' => !empty($referalCode->user->email) ? $referalCode->user->email : '',
            'leads_promo_phone' => !empty($referalCode->user->phone_number) ? $referalCode->user->phone_number : ''
        ];
        
        $data['module'] = "Leads";
        $data['token'] = $token;
        $client = new Client();
        $client->post(config('services.barantum.save_data_url'), ['json' => $data]);
    }
}
