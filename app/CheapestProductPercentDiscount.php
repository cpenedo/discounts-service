<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPercentDiscount extends Model
{
    public $categoryId;

    public $minimumAmount;
    
    public $percentDiscount;

    public function _construct($categoryId = 1, $minimumAmount = 2, $percentDiscount = 20)
    {
        $this->categoryId = $categoryId;
        $this->minimumAount = $minimumAmount;
        $this->percentDiscount = $percentDiscount;
    }
}
