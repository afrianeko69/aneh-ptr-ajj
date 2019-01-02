<?php

namespace App\Listeners;

use App\Events\ParticipantCardEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Ahmeng;

class ParticipantCardEmailEventListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  ParticipantparticipantEmailEvent  $event
     * @return void
     */
    public function handle(ParticipantCardEmailEvent $event)
    {
        $participants = $event->participants;
        $product = $event->product;

        $course_start = $product->course_start_at ? strtotime($product->course_start_at) : strtotime('2020-01-01 00:00:00');
        $course_end = $product->course_end_at ? strtotime($product->course_end_at) : strtotime('2020-01-01 03:00:00');
        $provider = $product->firstProvider();

        foreach ($participants as $participant) {
            $param = [
                'recipient' => [
                    'name' => $participant->name,
                    'email' => $participant->email,
                ],
                'product_name' => $product->name,
                'provider_name' => ($provider && $provider->name) ? $provider->name : 'HarukaEdu',
                'day' => dayInIndonesian(date('l', $course_start)),
                'date' => date('d/m/Y', $course_start),
                'course_start_at' => date('H:i', $course_start),
                'course_end_at' => date('H:i', $course_end),
                'location_detail' => $product->location_detail ?: 'Jakarta',
                'map_url' => $product->map ?: 'https://pintaria.com',
                'participant_code' => $participant->card_id ?: 'XXX',
                'redirect_to' => $participant->identifier 
                    ? route('stream.public.kartu.peserta', ['ident' => $participant->identifier]) 
                    : 'https://pintaria.com',
            ];

            $ahmeng = new Ahmeng;
            $ahmeng = $ahmeng->sendParticipantCardEmail($param);
        }
    }
}
