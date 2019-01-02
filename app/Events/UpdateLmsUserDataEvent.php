<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class UpdateLmsUserDataEvent
{
    use SerializesModels;

    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($lms_user_id, $name, $phone = null, $profile_picture = null, $address = null, $mobile_number = null)
    {
        $this->data = [
            'user_id' => $lms_user_id,
            'name' => $name,
            'phone_number' => $phone,
        ];

        if($profile_picture) {
            $this->data['profile_picture_object'] = $profile_picture;
        }

        if($address) {
            $this->data['address'] = $address;
        }

        if($mobile_number) {
            $this->data['mobile_number'] = $mobile_number;
        }
    }
}
