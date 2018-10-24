<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\FreeProductsDiscount;
use App\Order;
use App\OrderProduct;

class FreeProductsDiscountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function calculate_free_products_discount()
    {
        $freeProductsDiscount = new FreeProductsDiscount;

        $order = factory(Order::class, 1)->create()->each(function ($o) {
                        $o->orderProducts()->saveMany(factory(OrderProduct::class, 2)->make());
                    }
                );

        /* $this->assertEquals(
            $freeProductsDiscount->calculate($order),
            
        ); */
    }
}
