<?php

use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([

            'name'=>'essaa',
            'email'=>'eessaa7099@gmail.com',
            'password'=>bcrypt('123456789')

        ]);
    }
}
