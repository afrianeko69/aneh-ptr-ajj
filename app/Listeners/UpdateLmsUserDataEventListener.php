<?php

namespace App\Listeners;

use App\Events\UpdateLmsUserDataEvent;
use App\Services\Lms;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateLmsUserDataEventListener implements ShouldQueue
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
     * @param  UpdateLmsUserDataEvent  $event
     * @return void
     */
    public function handle(UpdateLmsUserDataEvent $event)
    {
        $this->lms->updateUserDetail($event->data);
    }
}
