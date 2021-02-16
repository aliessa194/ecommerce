<?php

use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        \App\Models\Setting::setMany([

            'default_local'=>'ar',
            'default_timezone'=>'africia/cairo',
            'reviews_enable'=>true,
            'auto_approve_reviwes'=>true,
            'supported_curencies'=>['USD','LE','SAR'],
            'default_curency'=>'USD',
            'store_email'=>'essaa7096@gmail.com',
            'search_engine'=>'msql',
            'local_sipping_cost'=>8,
            'outer_sipping_cost'=>8,
            'free_sipping_cost'=>8,
            'translatable'=>[
                'store_name'=>'DESER store',
                'free_sipping_lable'=>'free sipping',
                'local_lable'=>'local sipping',
                'outer_lable'=>'outer sipping'
            ],


        ]);

    }
}
