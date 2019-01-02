<?php

namespace Tests\Unit;

use App;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TryoutTest extends TestCase
{
    private $product;
    public function setUp() {
        parent::setUp();

        $this->product = factory(App\Product::class)->create([
            'is_tryout' => true
        ]);
        $this->product->each(function($u) {
            $u->tryouts()->save(factory(App\ProductTryout::class)->create());
        });
        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $this->product->slug,
            'user_id' => $this->affiliate->id,
        ]);
    }

    public function testInstructionPage() {
        $this->actingAs($this->affiliate)
            ->visit(route('tryout.instruction', [$this->product->slug]))
            ->see($this->product->tryouts()->orderBy('sort', 'asc')->first()->button_name)
            ->assertResponseStatus(200);
    }

    public function testAccessTryoutOfNotTryoutProduct() {
        $product = factory(App\Product::class)->create();
        $quiz = factory(App\ProductTryout::class)->create([
            'product_id' => $product->id,
        ]);
        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->affiliate->id,
        ]);

        $request = $this->actingAs($this->affiliate)
            ->call('GET', route('tryout.instruction', [$product->slug]));

        $this->assertEquals(404, $request->status());
    }

    public function testAccessTryoutQuiz() {
        $this->actingAs($this->affiliate)
            ->visit(route('tryout.quiz', [$this->product->slug, $this->product->tryouts()->first()->id]))
            ->see('Kelas Saya')
            ->assertResponseStatus(200);
    }

    public function testAccessTryoutQuizOnMoreThanOneQuiz() {
        $tryout = $this->product->tryouts()->first();
        $new_tryout = factory(App\ProductTryout::class)->create([
            'product_id' => $this->product->id,
            'sort' => ($tryout->sort + 1),
        ]);

        $this->actingAs($this->affiliate)
            ->visit(route('tryout.quiz', [$this->product->slug, $tryout->id]))
            ->dontSee('Kelas Saya')
            ->see($new_tryout->button_name)
            ->assertResponseStatus(200);

        $this->actingAs($this->affiliate)
            ->visit(route('tryout.quiz', [$this->product->slug, $new_tryout->id]))
            ->see('Kelas Saya')
            ->assertResponseStatus(200);
    }
}
