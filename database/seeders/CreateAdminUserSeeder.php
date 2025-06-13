<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or retrieve the admin user
        $user = User::updateOrCreate(
            ['email' => 'admin@matrimonial.com'],  // Search for user by email
            [
                'name' => 'Admin MiddleName LastName',
                'mobile' => '4444555566',
                'password' => Hash::make('abcd123')  // Hash the password
            ]
        );

        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],  // Search for user by email
            [
                'first_name' => 'Admin',
                'middle_name' => 'MiddleName',
                'last_name' => 'LastName',
                'email' => 'admin@matrimonial.com'
            ]
        );

        // Create or retrieve the admin role
        $role = Role::firstOrCreate(['name' => 'admin']);

        // Retrieve all permissions and sync them to the admin role
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        // Assign the role to the user
        $user->syncRoles([$role->id]);  // Use syncRoles to avoid duplication
    }
}