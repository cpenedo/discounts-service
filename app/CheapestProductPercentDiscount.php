<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPercentDiscount extends Model
{
    public $categoryId;

    public $minimumAmount;
    
    public $productDiscount;

    public function _construct($categoryId = 1, $minimumAmount = 2, $productDiscount = 20)
    {
        $this->categoryId = $categoryId;
        $this->minimumAount = $minimumAmount;
        $this->productDiscount = $productDiscount;
    }
}
