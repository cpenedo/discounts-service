<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\FreeProductsDiscount;
use App\Order;
use App\OrderProduct;
use App\Category;
use App\Product;

class FreeProductsDiscountTest extends TestCase
{
    use RefreshDatabase;

    protected $freeProductsDiscount;
    protected $category;
    protected $product;
    protected $order;
    protected $orderProduct;

    public function setUp()
    {
        parent::setUp();

        $this->freeProductsDiscount = new FreeProductsDiscount;

        $this->category = factory(Category::class)->create([
                            'id' => 2
                        ]);
                        
        $this->product = factory(Product::class)->create([
                            'category_id' => $this->category->id
                        ]);

        $this->order = factory(Order::class)->create();

        $this->orderProduct = factory(OrderProduct::class)->create([
            'product_id' => $this->product->id,
            'order_id' => $this->order->id,
            'quantity' => 6
        ]);
    }

    /** @test */
    public function calculate_free_products_discount()
    {
        $discountValue = $this->orderProduct->product->price * 1;

        $discount[0]['product_id'] = $this->product->id;
        $discount[0]['free_quantity'] = 1;
        $discount[0]['discount_value'] = $discountValue;

        $this->assertEquals(
            $this->freeProductsDiscount->calculate($this->order),
            $discount
        );

        $this->assertEquals(
            $this->product->orderProducts->first()->discount_value,
            $discountValue
        );
    }
}
