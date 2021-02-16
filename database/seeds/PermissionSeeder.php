<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            ['id' => '1', 'name' => 'view-Menu_Categories'],
            ['id' => '2', 'name' => 'add-Menu_Categories'],
            ['id' => '3', 'name' => 'update-Menu_Categories'],
            ['id' => '4', 'name' => 'delete-Menu_Categories'],



            ['id' => '5', 'name' => 'view-Product'],
            ['id' => '6', 'name' => 'add-Product'],
            ['id' => '7', 'name' => 'update-Product'],
            ['id' => '8', 'name' => 'delete-Product'],


            ['id' => '9', 'name' => 'view-Product_Categories'],
            ['id' => '10', 'name' => 'add-Product_Categories'],
            ['id' => '11', 'name' => 'update-Product_Categories'],
            ['id' => '12', 'name' => 'delete-Product_Categories'],



            ['id' => '13', 'name' => 'view-Content'],
            ['id' => '14', 'name' => 'add-Content'],
            ['id' => '15', 'name' => 'update-Content'],
            ['id' => '16', 'name' => 'delete-Content'],



            ['id' => '17', 'name' => 'view-Tags'],
            ['id' => '18', 'name' => 'add-Tags'],
            ['id' => '19', 'name' => 'update-Tags'],
            ['id' => '20', 'name' => 'delete-Tags'],



            ['id' => '21', 'name' => 'view-Testimonial'],
            ['id' => '22', 'name' => 'add-Testimonial'],
            ['id' => '23', 'name' => 'update-Testimonial'],
            ['id' => '24', 'name' => 'delete-Testimonial'],



            ['id' => '25', 'name' => 'view-Slider'],
            ['id' => '26', 'name' => 'add-Slider'],
            ['id' => '27', 'name' => 'update-Slider'],
            ['id' => '28', 'name' => 'delete-Slider'],



            ['id' => '29', 'name' => 'view-Gallery'],
            ['id' => '30', 'name' => 'add-Gallery'],
            ['id' => '31', 'name' => 'update-Gallery'],
            ['id' => '32', 'name' => 'delete-Gallery'],




            ['id' => '33', 'name' => 'view-Users'],
            ['id' => '34', 'name' => 'add-Users'],
            ['id' => '35', 'name' => 'update-Users'],
            ['id' => '36', 'name' => 'delete-Users'],



            
            ['id' => '37', 'name' => 'view-Roles'],
            ['id' => '38', 'name' => 'add-Roles'],
            ['id' => '39', 'name' => 'update-Roles'],
            ['id' => '40', 'name' => 'delete-Roles'],



            


        ];

        foreach ($permission as  $value) {
            DB::table('permissions')->insert([
                'id' => $value['id'],
                'name' => $value['name'],
                'guard_name' => 'web',
            ]);
        }
    }
}
