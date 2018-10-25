<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\CheapestProductPercentDiscount;
use App\Category;
use App\Product;
use App\Order;
use App\OrderProduct;

class CheapestProductPercentDiscountTest extends TestCase
{
    use RefreshDatabase;

    protected $category;
    protected $cheapestProduct;
    protected $priciestProduct;
    protected $order;
    protected $orderCheapestProduct;
    protected $orderPriciestProduct;

    public function setUp()
    {
        parent::setUp();

        $this->cheapestProductPercentDiscount = new CheapestProductPercentDiscount;

        $this->category = factory(Category::class)->create([
                            'id' => 1
                        ]);
                        
        $this->cheapestProduct = factory(Product::class)->create([
                            'category_id' => $this->category->id,
                            'price' => 10
                        ]);

        $this->priciestProduct = factory(Product::class)->create([
                            'category_id' => $this->category->id,
                            'price' => 100
                        ]);

        $this->order = factory(Order::class)->create();

        $this->orderCheapestProduct = factory(OrderProduct::class)->create([
            'product_id' => $this->cheapestProduct->id,
            'order_id' => $this->order->id,
            'quantity' => 5
        ]);

        $this->orderPriciestProduct = factory(OrderProduct::class)->create([
            'product_id' => $this->priciestProduct->id,
            'order_id' => $this->order->id,
            'quantity' => 2
        ]);
    }

    /** @test */
    public function calculate_cheapest_product_discount_value()
    {
        $discount['product_id'] = $this->cheapestProduct->id;
        $discount['discount_value'] = number_format($this->cheapestProduct->price * (floatval(20) / 100), 2);
        
        $this->assertEquals(
            $this->cheapestProductPercentDiscount->calculate($this->order),
            $discount
        );
    }
}
