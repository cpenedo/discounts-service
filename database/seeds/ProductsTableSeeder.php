<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/products.json');
        $data = json_decode($json);

        foreach($data as $obj) {
            Customer::create([
                'id' => $obj->id,
                'description' => $obj->description,
                'category' => $obj->category,
                'price' => $obj->price
            ]);
        }
    }
}
