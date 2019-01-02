<?php

namespace App\Events;

use App\StudentLead;
use Illuminate\Queue\SerializesModels;

class DaftarSayaBerminatEvent
{
    use SerializesModels;

    public $student_lead;
    public function __construct(StudentLead $student_lead)
    {
        $this->student_lead = $student_lead;
    }
}
