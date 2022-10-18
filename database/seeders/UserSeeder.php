<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table("users")->insert(
            array(
                    
                'user' => 'Administrador',
                'role_id' => 1,            
                'password' => bcrypt('123456'),
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("users")->insert(
            array(                  
                'user' => 'barra_1',
                'role_id' => 2,            
                'password' => bcrypt('123456'),
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("users")->insert(
            array(                  
                'user' => 'barra_2',
                'role_id' => 2,            
                'password' => bcrypt('123456'),
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
    }
}
