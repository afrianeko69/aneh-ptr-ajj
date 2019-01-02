<?php

namespace App\Listeners;

use App\ClassAttendee;
use App\UserParticipant;
use App\Events\ListKelasSayaEvent;
use App\Services\Lms;
use App\Traits\AttendeeCard;
use Cache;
use Carbon\Carbon;
use DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListKelasSayaEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $lms;
    public function __construct()
    {
        $this->lms = new Lms;
    }

    /**
     * Handle the event.
     *
     * @param  ListKelasSayaEvent  $event
     * @return void
     */
    public function handle(ListKelasSayaEvent $event)
    {
        $user = $event->user;
        $cache_key = 'event_list_kelas_saya_user_'.$user->id;
        $event_triggered = cache($cache_key, 0);
        if($event_triggered > 0) {
            Cache::decrement($cache_key, 1);
        }
        if($event_triggered > 3) {
            return false;
        }

        $classes = $this->lms->getUserKlass($user->provider_id);
        if($classes['status'] == 200) {
            // Update user courses
            $user_class_id = [];
            foreach($classes['data']->data as $course) {
                $class = ClassAttendee::updateOrCreate(
                    ['user_id' => $user->id, 'slug' => $course->course_slug],
                    [
                        'lms_klass_id' => $course->klass_id,
                        'lms_course_id' => $course->course_id,
                        'lms_course_name' => $course->course_name,
                        'lms_custom_url' => ($course->custom_url_lms ? $course->custom_url_lms : null),
                        'attendance_completion_percentage' => $course->avg_completion_percentage,
                    ]
                );
                array_push($user_class_id, $class->id);
                
                # Generate attendee card ID if it's offline course
                if (($class->product->isOfflineCourse()) && !UserParticipant::productUserParticipant($class->user_id, $class->product->id)->count()) {
                    AttendeeCard::setAttendeeCardId($class);
                }

                if($class->certificate_number || !$course->is_get_certificate) {
                    continue;
                }
                
                // Generate certificate for user
                DB::transaction(function() use ($course, $class) {
                    $now = Carbon::now();

                    $running_number = sprintf("%04d", 1);
                    $last_certificate_number = ClassAttendee::whereNotNull('certificate_number')
                                                ->whereSlug($course->course_slug)
                                                ->orderBy('certificate_number', 'DESC')
                                                ->select(['certificate_number'])
                                                ->first();

                    if($last_certificate_number) {
                        $running_number = sprintf("%04d", (int) (substr($last_certificate_number->certificate_number, -4)) + 1);
                    }

                    $class->certificate_number = generateECertificateNumber($course->course_code, $class->product->module_number, $now->format('Ymd'), $running_number);
                    $class->certificate_published_at = $now;
                    $class->save();
                }, 3);
            }

            ClassAttendee::whereUserId($user->id)
                        ->whereNotIn('id', $user_class_id)
                        ->delete();
        }
    }
}
