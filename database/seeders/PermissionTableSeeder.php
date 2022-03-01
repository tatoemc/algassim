<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'print',
            'exel',
            'orphan-list',
            'orphan-create',
            'orphan-edit',
            'orphan-delete',
            
            'sponsor-list',
            'sponsor-create',
            'sponsor-edit',
            'sponsor-delete',
            
            'guardian-list',
            'guardian-create',
            'guardian-edit',
            'guardian-delete',
          
            'sponserform-list',
            'sponserform-create',
            'sponserform-edit',
            'sponserform-delete',
            
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'dept-list',
            'dept-create',
            'dept-edit',
            'dept-delete',
            
            'payment-list',
            'payment-create',
            'payment-edit',
            'payment-delete'


            ];

       foreach ($permissions as $permission) 
       {
       Permission::create(['name' => $permission]);
        }

    }//end of run

}
