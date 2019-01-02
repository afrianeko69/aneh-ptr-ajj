<?php

namespace App\Traits;

use App\ClassAttendee;
use App\UserParticipant;
use Carbon\Carbon;

trait AttendeeCard
{
    public static function getCurrentAttendeeNumber($product_id)
    {
        $last_no = UserParticipant::where('product_id', $product_id)
            ->whereNotNull('card_id')
            ->select('card_id')
            ->orderBy('card_id', 'DESC')
            ->first();

        if (!$last_no) return 0;
        return (int) substr($last_no->card_id, 0, 3);
    }

    public static function setAttendeeCardId(ClassAttendee $attendee)
    {
        $attendee_no = self::getCurrentAttendeeNumber($attendee->product->id) + 1;
        $training_code = $attendee->product->training_code ?: 'XXX';

        $date = date_parse_from_format('Y-m-d H:i:s', $attendee->product->course_start_at);
        $course_date = sprintf('%02d', $date['month']) . substr($date['year'], -2);

        $provider = $attendee->product->providers()
            ->select('provider_code')
            ->orderByRaw('sort is null, sort ASC')
            ->first();
        $provider_code = isset($provider->provider_code) && !empty($provider->provider_code) ? $provider->provider_code : 'XX';

        $participants = UserParticipant::productUserParticipant($attendee->user_id, $attendee->product->id);

        if ($participants->count()) {
            foreach ($participants->get() as $participant) {
                $participant->card_id = self::generateAttendeeCardId($attendee_no, $training_code, $course_date, $provider_code);
                $participant->identifier = UserParticipant::generateIdentifier();
                $participant->card_published_at = Carbon::now();
                $participant->save();
                $attendee_no++;
            }
        } else {
            // No data (possibly because free course)
            $participants->create([
                'user_id' => $attendee->user_id,
                'product_id' => $attendee->product->id,
                'name' => $attendee->user->name,
                'email' => $attendee->user->email,
                'card_id' => self::generateAttendeeCardId($attendee_no, $training_code, $course_date, $provider_code),
                'identifier' => UserParticipant::generateIdentifier(),
                'card_published_at' => Carbon::now(),
            ]);
        }
        return $participants->get();
    }

    public static function generateAttendeeCardId($number, $training_code, $course_date, $provider_code)
    {
        return sprintf('%03d', $number) . $training_code . $course_date . '-' . $provider_code;
    }
}
