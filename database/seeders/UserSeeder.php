<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        // ... Some Truncate Query
        User::truncate();
        
        Schema::enableForeignKeyConstraints();

        $roles = ['user','admin','suadmin'];
        foreach($roles as $key=>$role){

          Role::create(['name' => $role]);
          $user =  User::create([
                'name' => $role,
                'email' => $role."@gmail.com",
                'password' => bcrypt('a')
            ]);
            $user-> syncRoles($role);
        }




    }
}
