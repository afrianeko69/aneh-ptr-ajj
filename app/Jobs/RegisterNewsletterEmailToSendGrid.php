<?php

namespace App\Jobs;

use App\Newsletter;
use App\Services\SendGrid;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RegisterNewsletterEmailToSendGrid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public $newsletter;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = ['email' => $this->newsletter->email];
        $sendgrid = new SendGrid();
        $subscribe_marketing_campaign = $sendgrid->subscribeUserToMarketingCampaign($data);
    }
}
