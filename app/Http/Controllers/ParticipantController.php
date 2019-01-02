<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserParticipant;
use PDF;

class ParticipantController extends Controller
{
    public function streamCard($ident)
    {
        $participant = UserParticipant::identifier($ident)->first();
        if (!$participant) return abort(404);

        $product = $participant->product;
        if (!$product) return abort(404);

        $data[] = [
            'name' => $participant->name,
            'attendee_card_id' => $participant->card_id,
            'course' => $product->name,
            'date' => date('d/m/Y', strtotime($product->course_start_at)),
            'time' => date('H:i', strtotime($product->course_start_at)) . ' - ' . date('H:i', strtotime($product->course_end_at)) . ' WIB',
        ];

        return PDF::loadView('pintaria3.profiles.attendee_card_template', ['attendees' => $data])
            ->setPaper('comm10e')
            ->setOrientation('landscape')
            ->setOption('margin-bottom', 0)
            ->setOption('margin-top', 0)
            ->setOption('margin-left', 0)
            ->setOption('margin-right', 0)
            ->inline('kartu-peserta-' . $participant->card_id . '.pdf');
    }
}
