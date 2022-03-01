<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    

    public function run()
    {
        $user = User::create([
            'name' => 'Mustafa Adel', 
            'email' => 'mostafa@gmail.com',
            'password' => bcrypt('newday77'),
            'user_type' => 'admin',
            'gender' => 'ذكر',
            'phone' => '0911405218',
            'bank_account' => '1225345',
            'add' => 'الخرطوم',
            'ssn' => '123-2589-2569',
            'roles_name' => ["admin"],
            'status' => 'مفعل',
            'images' => 'default.png',
            ]);
            
            $role = Role::create(['name' => 'admin']);
            
            $permissions = Permission::pluck('id','id')->all();
            
            $role->syncPermissions($permissions);
            
            $user->assignRole([$role->id]);

    }
}
