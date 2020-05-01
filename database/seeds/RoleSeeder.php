<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = Role::create([
            'name'=>'administrator'
        ]);
        $role->users()->create([

            'name'=>'Erand Elmaz',
            'email'=>'eelmazi8@gmail.com',
            'password'=>Hash::make('12345678'),
        ]);


    }
}
