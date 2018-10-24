<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\TotalPercentDiscount;

class TotalPercentDiscountTest extends TestCase
{
    /** @test */
    public function calculate_total_discount_value()
    {
        $totalPercentDiscount = new TotalPercentDiscount;

        $orderValue = 1000;

        $this->assertEquals(
            $totalPercentDiscount->calculate($orderValue),
            100
        );
    }
}
