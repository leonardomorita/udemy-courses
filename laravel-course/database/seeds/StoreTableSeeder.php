<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = \App\Store::all();

        foreach ($stores as $store) {
            // Para cada loja, será criado um produto que vinculará com a loja
            $store->products()->save(factory(\App\Product::class)->make());
        }
    }
}
