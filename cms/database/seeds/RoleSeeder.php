<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\Role::where("slug", ADMIN_ROLE)->first();
        if(!$admin){
            $arr = [
                'name' => 'Admin',
                'slug' => ADMIN_ROLE,
                'description' => '',
                'level' => 100
            ];
            $admin = \App\Models\Role::create($arr);

        }
        $permissions = \App\Models\Permission::get()->pluck("id")->toArray();
        $admin->syncPermissions($permissions);

        $user = \App\Models\Role::where("slug", "user")->first();
        if(!$user){
            $arr = [
                'name' => 'User',
                'slug' => 'user',
                'description' => '', 
                'level' => 1
            ];
            \App\Models\Role::create($arr);
        }
    }
}
