<?php

namespace App\Listeners;

use App\User;
use App\UserReferralCode;
use App\Events\GenerateReferralCodeEvent;
use App\Services\Mutual;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateReferralCodeEventListener implements ShouldQueue
{
    private $mutual;
    public function __construct() {
        $this->mutual = new Mutual;
    }
    /**
     * Handle the event.
     *
     * @param  GenerateReferralCodeEvent  $event
     * @return void
     */
    public function handle(GenerateReferralCodeEvent $event)
    {
        $payload = $event->payload;

        $user = User::whereEmail($payload['email'])->first();
        if($user && !$user->default_referral_code->first()) {
            $create_referral_code = $this->mutual->generateReferralCode($payload);
            if($create_referral_code['status'] == 201) {
                UserReferralCode::create([
                    'user_id' => $user->id,
                    'referral_code' => $create_referral_code['body']['referral_code'],
                    'is_default' => 1,
                ]);
            }
        }
    }
}
