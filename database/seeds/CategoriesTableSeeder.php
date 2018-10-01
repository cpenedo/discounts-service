<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/categories.json');
        $data = json_decode($json);

        foreach($data as $obj) {
            Customer::create([
                'id' => $obj->id,
                'name' => $obj->name
            ]);
        }
    }
}
