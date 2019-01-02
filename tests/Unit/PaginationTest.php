<?php

namespace Tests\Unit;

use App;
use App\Traits\PaginationHelper;
use Tests\TestCase;

class PaginationTest extends TestCase
{
    public $currentPage = 5;
    public $maxPage = 5;
    public $elements = [
        [
            0 => [
                1 => 'Pages/3',
                2 => 'Pages/3',
                3 => 'Pages/3',
                4 => 'Pages/3',
            ],
            1 => '...',
        ],
        [
            3 => [
                1 => 'Pages/3',
                2 => 'Pages/3',
                3 => 'Pages/3',
                4 => 'Pages/3',
                5 => 'Pages/3',
                6 => 'Pages/3',
                7 => 'Pages/3',
            ],
            4 => '...',
        ],
        [
            1 => '...',
            2 => [
                4 => 'Pages/3',
                5 => 'Pages/3',
                6 => 'Pages/3',
            ],
            3 => '...',
        ],
        [
            1 => '...',
            2 => [
                2 => 'Pages/3',
                3 => 'Pages/3',
                4 => 'Pages/3',
                5 => 'Pages/3',
                6 => 'Pages/3',
            ],
        ],
    ];

    
    public function setUp() {
        parent::setUp();
    }

    public function testCountPages()
    {
        foreach ($this->elements as $k => $element) {
            $new_element = PaginationHelper::correct($element);
            $this->assertTrue(is_array($new_element));
            $this->assertLessThanOrEqual($this->maxPage, PaginationHelper::countElements($new_element));           
        }
    }
}
