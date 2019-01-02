<?php

namespace Tests\Unit;

use App;
use App\Jobs\RegisterNewsletterEmailToSendGrid;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    public function testFailedSubmitNewsletter() {
        $request = $this->call('post', route('newsletter.store'));
        $this->assertEquals(302, $request->status());
    }

    public function testNotPassedNewsletterEmailValidation() {
        $request = $this->call('post', route('newsletter.store'), [
            'email' => 'abc'
        ]);
        $this->assertEquals(302, $request->status());
    }

    public function testRegisterNewsletterAlreadySentToSendGrid() {
        Queue::fake();

        $user_email_newsletter = factory(App\Newsletter::class)->create([
            'is_registered_to_sendgrid' => 1
        ]);

        $request = $this->call('post', route('newsletter.store'), [
            'email' => $user_email_newsletter->email
        ]);

        $response = json_decode((string) $request->getContent(), true);

        $this->assertEquals(400, $request->status());
        $this->seeJsonStructure([
            'status', 'message'
        ]);
        $this->assertEquals($response['message'], 'Anda sudah pernah mendaftar Newsletter Kami.');

        Queue::assertNotPushed(RegisterNewsletterEmailToSendGrid::class);
    }

    public function testSuccessRegisterToNewsletterBeforeIntegrationWithSendgrid() {
        Queue::fake();

        $user_email_newsletter = factory(App\Newsletter::class)->create([
            'is_registered_to_sendgrid' => 0
        ]);

        $request = $this->call('post', route('newsletter.store'), [
            'email' => $user_email_newsletter->email
        ]);

        $response = json_decode((string) $request->getContent(), true);

        $this->assertEquals(200, $request->status());
        $this->seeJsonStructure([
            'status', 'message'
        ]);
        $this->assertEquals($response['message'], 'Anda telah terdaftar berlangganan pada Newsletter kami.');

        Queue::assertPushed(RegisterNewsletterEmailToSendGrid::class, function($job) use ($user_email_newsletter) {
            return $job->newsletter->id == $user_email_newsletter->id;
        });
    }

    public function testSuccessRegisterToNewsletterForNewUser() {
        Queue::fake();

        $request = $this->call('post', route('newsletter.store'), [
            'email' => 'zaza@gmail.com',
        ]);

        $response = json_decode((string) $request->getContent(), true);

        $this->assertEquals(200, $request->status());
        $this->seeJsonStructure([
            'status', 'message'
        ]);
        $this->assertEquals($response['message'], 'Anda telah terdaftar berlangganan pada Newsletter kami.');

        $newsletter = App\Newsletter::where('email', 'zaza@gmail.com')->first();
        Queue::assertPushed(RegisterNewsletterEmailToSendGrid::class, function($job) use ($newsletter) {
            return $job->newsletter->id == $newsletter->id;
        });
    }
}
