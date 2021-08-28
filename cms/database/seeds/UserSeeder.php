<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where("email", "nongsan@laptrinh.com")->first();
        if(!$user){
            $arr = [
                'name' => 'Admin',
                'email' => 'nongsan@laptrinh.com',
                "password" => Hash::make("123456"),
                "active" => 1,
                "active_code" => uniqid()
            ];
            $user = \App\Models\User::create($arr);
        }
        $admin = \App\Models\Role::where("slug", "admin")->first();
        if($admin){
            $user->syncRoles([$admin->id]);
        }
    }
}
