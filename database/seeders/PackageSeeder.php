<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Seed the packages table.
     */
    public function run(): void
    {
        // Create some default packages
        Package::create([
            'name' => 'Basic',
            'tokens' => 10,
            'validity' => 30,
            'description' => 'Basic package',
            'price' => 9.99,
        ]);
        Package::create([
            'name' => 'Standard',
            'tokens' => 25,
            'validity' => 90,
            'description' => 'Standard package',
            'price' => 19.99,
        ]);
        Package::create([
            'name' => 'Premium',
            'tokens' => 50,
            'validity' => 180,
            'description' => 'Premium package',
            'price' => 29.99,
        ]);
    }
}
