<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreeProductDiscount extends Model
{
    public $cateboryId;

    public $minimumAmount;

    public $freeProducts;

    public function _construct($cateboryId = 2, $minimumAmount = 5, $freeProducts = 1)
    {
        $this->cateboryId = $cateboryId;
        $this->minimumAmount = $minimumAmount;
        $this->freeProducts = $freeProducts;
    }
}
