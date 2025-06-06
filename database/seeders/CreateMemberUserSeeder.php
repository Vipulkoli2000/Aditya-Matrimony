<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateMemberUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $user = User::updateOrCreate(
        //     ['email' => 'ganesh@gmail.com'], // Search for user by email
        //     [
        //         'name' => 'ganesh',
        //         'password' => Hash::make('Aditya123') // Hash the password
        //     ]
        // );

        // Create or retrieve the admin role
        $role = Role::firstOrCreate(['name' => 'member']);

        $permissions = [

        ];
        $permissions = Permission::pluck('id', 'id')->all();
        // $adminRole->givePermissionTo($permissions);

        $role->syncPermissions($permissions);

        // $user->assignRole([$role->id]);
    }
}