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
        // Create or update default packages without duplicating entries
        $packages = [
            [
                'name' => 'Basic',
                'tokens' => 10,
                'validity' => 30,
                'description' => 'Basic package',
                'price' => 9.99,
            ],
            [
                'name' => 'Standard',
                'tokens' => 25,
                'validity' => 90,
                'description' => 'Standard package',
                'price' => 19.99,
            ],
            [
                'name' => 'Premium',
                'tokens' => 50,
                'validity' => 180,
                'description' => 'Premium package',
                'price' => 29.99,
            ],
        ];

        foreach ($packages as $package) {
            Package::updateOrCreate(
                ['name' => $package['name']], // Unique constraint to prevent duplicates
                $package
            );
        }
    }
}
