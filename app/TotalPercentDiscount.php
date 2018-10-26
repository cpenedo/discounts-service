<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TotalPercentDiscount extends Model
{
    public $percentDiscount;

    public $minimumOrderValue;

    public function __construct($percentDiscount = 10, $minimumOrderValue = 1000)
    {
        $this->percentDiscount = $percentDiscount;
        $this->minimumOrderValue = $minimumOrderValue;
    }

    public function calculate($orderValue)
    {
        if($orderValue >= $this->minimumOrderValue) {
            return number_format($orderValue * (floatval($this->percentDiscount) / 100), 2);
        }

        return false;
    }
}
