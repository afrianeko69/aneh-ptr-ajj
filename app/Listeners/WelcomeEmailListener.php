<?php

namespace App\Listeners;

use App\Events\WelcomeEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Ahmeng;

class WelcomeEmailListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  WelcomeEmailEvent  $event
     * @return void
     */
    public function handle(WelcomeEmailEvent $event)
    {
        $post = $event->post;

        $sendInfo = [
            'recipient' => [
                'name' => $post['name'],
                'email' => $post['email']
            ]
        ];
        $ahmeng = new Ahmeng;
        $ahmeng = $ahmeng->sendWelcomeEmail($sendInfo);
    }
}
