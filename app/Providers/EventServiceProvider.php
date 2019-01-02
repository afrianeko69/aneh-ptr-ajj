<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\DaftarSayaBerminatEvent' => [
            'App\Listeners\DaftarSayaBerminatEventListener',
        ],
        'App\Events\WelcomeEmailEvent' => [
            'App\Listeners\WelcomeEmailListener',
        ],
        'App\Events\ListKelasSayaEvent' => [
            'App\Listeners\ListKelasSayaEventListener',
        ],
        'App\Events\EnrollToKlassEvent' => [
            'App\Listeners\EnrollToKlassEventListener',
        ],
        'App\Events\UpdateLmsUserDataEvent' => [
            'App\Listeners\UpdateLmsUserDataEventListener',
        ],
        'App\Events\HubungiKamiKuliahEvent' => [
            'App\Listeners\HubungiKamiKuliahEventListener',
        ],
        'App\Events\GenerateReferralCodeEvent' => [
            'App\Listeners\GenerateReferralCodeEventListener',
        ],
        'App\Events\ReferralEmailEvent' => [
            'App\Listeners\ReferralEmailEventListener',
        ],
        'App\Events\MoreInfoEmailEvent' => [
            'App\Listeners\MoreInfoEmailEventListener',
        ],
        'App\Events\ParticipantCardEmailEvent' => [
            'App\Listeners\ParticipantCardEmailEventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
