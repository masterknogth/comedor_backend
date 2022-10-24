<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table("configurations")->insert(
            array(
                    
                'codigo' => 'normal',
                'status' => 1,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("configurations")->insert(
            array(
                    
                'codigo' => 'enamorados',
                'status' => 0,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("configurations")->insert(
            array(
                    
                'codigo' => 'halloween',
                'status' => 0,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("configurations")->insert(
            array(
                    
                'codigo' => 'navidad',
                'status' => 0,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
    }
}
