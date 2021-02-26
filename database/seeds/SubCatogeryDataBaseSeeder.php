<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class SubCatogeryDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Category::class,10)->create([
            'parent_id' => $this -> getRandamParentId()
        ]);

    }

    private function getRandamParentId()
    {
        $sss= \App\Models\Category::inRandomOrder()->first();
        return $sss;
    }
}
