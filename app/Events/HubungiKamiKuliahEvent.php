<?php

namespace App\Events;

use App\StudentLead;
use Illuminate\Queue\SerializesModels;

class HubungiKamiKuliahEvent
{
    use SerializesModels;

    public $student_lead;
    public $source;
    public function __construct(StudentLead $student_lead , $source)
    {
        $this->student_lead = $student_lead;
        $this->source = $source;
    }
}