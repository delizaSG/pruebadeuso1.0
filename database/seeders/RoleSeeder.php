<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //$role1= Role::create(['name'=>'contador1']);
        //$role2=Role::create(['name'=>'contador2']);
        //Permission::create(['name'=>'home'])->syncRoles([$role1,$role2]);
       // Permission::create(['name'=>'asigneds.index'])->syncRoles([$role2]);
      
     /*  $user1= User::create([
            'name' => 'zenon',
            'email' => 'zenon',
            'password' => Hash::make('zenon123'),
        ]);
        $user1->assignRole('contador1');

        $user2= User::create([
            'name' => 'juan',
            'email' => 'juan',
            'password' => Hash::make('juan1234'),
        ]);
        $user2->assignRole('contador2');
        */
        $user3= User::create([
            'name' => 'Daniel',
            'email' => 'daniel123',
            'password' => Hash::make('juan1234'),
        ]);
        $user3->assignRole('contador2');

    }
}
