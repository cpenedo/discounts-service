<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\TotalPercentDiscount;
use App\Order;

class TotalPercentDiscountTest extends TestCase
{
    use RefreshDatabase;

    protected $totalPercentDiscount;

    public function setUp()
    {
        parent::setUp();

        $this->totalPercentDiscount = new TotalPercentDiscount;
    }

    /** @test */
    public function calculate_total_discount_value()
    {
        $order = factory(Order::class)->create([
            'total' => 1000
        ]);

        $discountValue = 100;

        $this->assertEquals(
            $this->totalPercentDiscount->calculate($order->total),
            $discountValue
        );
    }
}
