<?php

namespace App\Listeners;

use App\Events\ReferralEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Ahmeng;

class ReferralEmailEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReferralEmailEvent  $event
     * @return void
     */
    public function handle(ReferralEmailEvent $event)
    {
        $referral = $event->referral;

        $params = [
            'recipient' => [
                'email' => $referral['email'],
            ],
            'sender_name' => $referral['name'],
            'redirect_to' => $referral['redirect_to'],
        ];

        $ahmeng = new Ahmeng;
        $ahmeng->sendReferralEmail($params);
    }
}
