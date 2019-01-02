<?php

namespace Tests\Unit;

use App\Product;
use App\Profession;
use Tests\TestCase;

class ProfessionTest extends TestCase
{
    private $profession;
    public function setUp()
    {
        parent::setUp();
        $this->profession = factory(Profession::class)->create();
    }

    public function testIndex()
    {
        $this->visit('/profesi')
            ->see('Profesi')
            ->assertResponseStatus(200);
    }

    public function testNotFoundDetail()
    {
        $request = $this->call('GET', route('profession.detail', ['abcs']));
        $this->assertEquals(404, $request->status());
    }

    public function testDetailFound()
    {
        $profession = factory(Profession::class)->create([
            'name' => 'Customer Service'
        ]);

        $products = factory(Product::class, 3)->create()->each(function($u) use ($profession) {
            $u->professions()->save($profession);
        });

        $slug_name = str_replace(' ','-',$profession->name);
        $this->visit('/profesi/'.$slug_name)
             ->see($profession->name)
             ->see($products[0]->name)
             ->assertResponseStatus(200);
    }

    public function testSeeCategoryNameAndExcerpt()
    {
        $profession = factory(Profession::class)->create([
            'name' => 'Web Developer'
        ]);

        $product = factory(Product::class)->create();
        $product->professions()->save($profession);

        $slug = str_replace(' ', '-', $profession->name);

        $this->visit('/profesi/' . $slug)
             ->see($product->category_name)
             ->see($product->excerpt)
             ->assertResponseStatus(200);
    }

    public function testSeeProfessionDetailVisibleFields()
    {
        $slug = str_replace(' ', '-', $this->profession->name);
        $this->visit('/profesi/' . $slug)
            ->see('Deskripsi')
            ->see($this->profession->description)
            ->see('Gaji')
            ->see($this->profession->pay)
            ->see('Tugas')
            ->see($this->profession->task)
            ->see('Pengetahuan')
            ->see($this->profession->knowledge)
            ->see('Keterampilan dan Kemampuan')
            ->see($this->profession->skill)
            ->assertResponseOk();
    }

    public function testNotSeeNotReadyProfession()
    {
        $profession = factory(Profession::class)->create([
            'is_content_ready' => 0,
        ]);

        $this->visit('/profesi')
            ->dontSee($profession->name)
            ->assertResponseOk();

        $slug = str_replace(' ', '-', $profession->name);
        $this->get('/profesi/' . $slug)
            ->assertResponseStatus(404);
    }

    public function testSeeJoobleAndRelatedProducts()
    {
        $profession = factory(Profession::class)->create([
            'jooble' => 'Web Developer',
        ]);

        $products = factory(Product::class)->create()->each(function ($u) use ($profession) {
            $u->professions()->save($profession);
        });

        $this->visit('/profesi/' . str_replace(' ', '-', $profession->name))
            ->see('Lowongan Pekerjaan')
            ->see('Program Terkait')
            ->assertResponseOk();
    }
}
