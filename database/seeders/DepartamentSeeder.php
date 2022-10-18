<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 10,
                'name' => 'ADMINISTRACION',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 11,
                'name' => 'CONSTRUCCIONES CIVILES',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 12,
                'name' => 'ELECTRICIDAD',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 13,
                'name' => 'INFORMATICA',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 15,
                'name' => 'MECANICA',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 16,
                'name' => 'TECNOLOGIA DE MATERIALES',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 18,
                'name' => 'PROCESOS QUIMICOS',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 19,
                'name' => 'QUIMICA',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 93,
                'name' => 'VIGILANCIA PRIVADA',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 94,
                'name' => 'TRANSPORTE ENRIQUE',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 95,
                'name' => 'FUNDATEC',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 96,
                'name' => 'INDUSERVI',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 97,
                'name' => 'CAPROFIUT',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 98,
                'name' => 'VISITANTES',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );
        \DB::table("departaments")->insert(
            array(
                    
                'code' => 99,
                'name' => 'GUARDERIA',            
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            )
        );


        
    
    }
}
