<?php

namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;

class EnrollToKlassEvent
{
    use SerializesModels;

    public $user;
    public $slug;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $slug)
    {
        $this->user = $user;
        $this->slug = $slug;
    }
}
