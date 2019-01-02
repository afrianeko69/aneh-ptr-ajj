<?php

namespace App\Listeners;

use App\ClassAttendee;
use App\Services\Lms;
use App\Events\EnrollToKlassEvent;
use App\Events\ParticipantCardEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Traits\AttendeeCard;

class EnrollToKlassEventListener
{
    private $lms;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->lms = new Lms;
    }

    /**
     * Handle the event.
     *
     * @param  EnrollToKlassEvent  $event
     * @return void
     */
    public function handle(EnrollToKlassEvent $event)
    {
        $user = $event->user;
        $slug = $event->slug;

        $enroll_user = $this->lms->enrollUserToCourse($user->provider_id, $slug);
        if($enroll_user['status'] == 201) {
            $body = $enroll_user['body'];
            $attendee = ClassAttendee::updateOrCreate(
                ['user_id' => $user->id, 'slug' => $slug],
                [
                    'lms_klass_id' => $body['klass_id'],
                    'lms_course_id' => $body['course']['id'],
                    'lms_course_name' => $body['course']['name'],
                    'lms_custom_url' => ($body['course']['custom_url_lms'] ? $body['course']['custom_url_lms'] : null),
                ]
            );

            # Generate attendee card ID if it's offline course
            $product = $attendee->product;
            if ($product->isOfflineCourse()) {
                $cards = AttendeeCard::setAttendeeCardId($attendee);
                if ($cards && !empty($cards[0]->card_id)) {
                    event(new ParticipantCardEmailEvent($cards, $product));
                }
            }
        }
    }
}
