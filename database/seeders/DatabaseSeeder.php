<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\CreateMemberUserSeeder;
use Database\Seeders\PackageSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateMemberUserSeeder::class);
        $this->call(PackageSeeder::class);
        $profilesToGenerate = (int) env('PROFILES_PER_USER', 0);
        // generate users and attach one profile each
        \App\Models\User::factory($profilesToGenerate)->create()->each(function($user) {
            \App\Models\Profile::factory()->create([
                'user_id' => $user->id,
                'email'   => $user->email,
                'mobile'  => $user->mobile,
            ]);
        });
        // seed profile_packages linking profile and packages randomly
        \App\Models\Profile::all()->each(function($profile) {
            $package = \App\Models\Package::inRandomOrder()->first();
            \App\Models\ProfilePackage::create([
                'profile_id' => $profile->id,
                'package_id' => $package->id,
                'tokens_received' => $package->tokens,
                'tokens_used' => 0,
                'starts_at' => now(),
                'expires_at' => now()->addDays($package->validity),
            ]);
        });
    }
}
