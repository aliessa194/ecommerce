<?php

use Illuminate\Database\Seeder;



class ProductDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\models\Product::class,50)->create();

    }
}

