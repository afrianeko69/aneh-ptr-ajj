<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class GenerateReferralCodeEvent
{
    use SerializesModels;

    public $payload;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }
}
