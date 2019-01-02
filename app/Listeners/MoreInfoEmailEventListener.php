<?php

namespace App\Listeners;

use App\Events\MoreInfoEmailEvent;
use App\Product;
use App\Services\Ahmeng;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MoreInfoEmailEventListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  MoreInfoEmailEvent  $event
     * @return void
     */
    public function handle(MoreInfoEmailEvent $event)
    {
        $data = $event->data;

        $param = [
            'recipient' => [
                'name' => $data['name'],
                'email' => $data['email']
            ],
            'is_degree' => (strtolower($data['product_category']) == Product::CATEGORY_KULIAH_NAME ? true : false),
        ];
        $ahmeng = new Ahmeng;
        $ahmeng = $ahmeng->sendMoreInfoEmail($param);
    }
}
