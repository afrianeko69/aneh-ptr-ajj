<?php

namespace App\Traits;

use Carbon\Carbon;

trait UserTimezone {
    public function getUserTimezone($attribute, $format = 'd F Y H:i') {
        $timezone = 'Asia/Jakarta';

        if($this->{$attribute} instanceof Carbon) {
            $data = $this->{$attribute}->timezone($timezone);
        } else {
            return '-';
        }
        return $data->format($format);
    }
}