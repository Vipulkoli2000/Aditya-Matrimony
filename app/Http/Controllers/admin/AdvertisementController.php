<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdvertisementController extends Controller
{
    public function create()
    {
        $advertisement = Advertisement::getOrCreate();
        return view('admin.advertisement.create', compact('advertisement'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'advertisement_1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'advertisement_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Get or create advertisement record
        $advertisement = Advertisement::getOrCreate();
        
        // Handle advertisement 1
        if ($request->hasFile('advertisement_1')) {
            // Delete old file if exists
            if ($advertisement->advertisement_1) {
                Storage::delete('public/advertisements/' . $advertisement->advertisement_1);
            }
            
            $file = $request->file('advertisement_1');
            $extension = $file->extension();
            $name = 'advertisement-1.' . $extension;
            $file->storeAs('public/advertisements', $name);
            $advertisement->advertisement_1 = $name;
        }
        
        // Handle advertisement 2
        if ($request->hasFile('advertisement_2')) {
            // Delete old file if exists
            if ($advertisement->advertisement_2) {
                Storage::delete('public/advertisements/' . $advertisement->advertisement_2);
            }
            
            $file = $request->file('advertisement_2');
            $extension = $file->extension();
            $name = 'advertisement-2.' . $extension;
            $file->storeAs('public/advertisements', $name);
            $advertisement->advertisement_2 = $name;
        }
        
        $advertisement->save();

        return redirect()->back()->with('success', 'Advertisements updated successfully.');
    }
}
