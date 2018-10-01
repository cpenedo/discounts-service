<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/customers.json');
        $data = json_decode($json);

        foreach($data as $obj) {
            Customer::create([
                'id' => $obj->id,
                'name' => $obj->name,
                'since' => $obj->since,
                'revenue' => $obj->revenue
            ]);
        }
    }
}
