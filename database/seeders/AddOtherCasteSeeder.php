<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Caste;
use App\Models\SubCaste;

class AddOtherCasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if 'Other' caste already exists
        $otherCaste = Caste::where('name', 'Other')->first();
        
        if (!$otherCaste) {
            $otherCaste = Caste::create(['name' => 'Other']);
        }
        
        // Check if 'Other' subcaste already exists for the 'Other' caste
        $otherSubCaste = SubCaste::where('name', 'Other')
            ->where('caste_id', $otherCaste->id)
            ->first();
            
        if (!$otherSubCaste) {
            SubCaste::create([
                'name' => 'Other',
                'caste_id' => $otherCaste->id
            ]);
        }
        
        // Also add 'Other' subcaste option to all existing castes
        $allCastes = Caste::where('name', '!=', 'Other')->get();
        
        foreach ($allCastes as $caste) {
            $existingOtherSubCaste = SubCaste::where('name', 'Other')
                ->where('caste_id', $caste->id)
                ->first();
                
            if (!$existingOtherSubCaste) {
                SubCaste::create([
                    'name' => 'Other',
                    'caste_id' => $caste->id
                ]);
            }
        }
    }
}
