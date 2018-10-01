<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    static public $TOOLS = 1;
    static public $SWITCHES = 2;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    static public function a()
    {
        return 2;
    }
}
