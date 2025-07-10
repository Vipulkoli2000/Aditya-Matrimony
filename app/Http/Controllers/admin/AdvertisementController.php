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
            'carousel_1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'carousel_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'carousel_3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'carousel_4' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'advertisement_1.image' => 'Advertisement 1 must be an image file.',
            'advertisement_1.mimes' => 'Advertisement 1 must be a file of type: jpeg, png, jpg, webp.',
            'advertisement_1.max' => 'Advertisement 1 may not be greater than 2MB. Recommended size: 375x200 pixels.',
            'carousel_1.image' => 'Carousel Image 1 must be an image file.',
            'carousel_1.mimes' => 'Carousel Image 1 must be a file of type: jpeg, png, jpg, webp.',
            'carousel_1.max' => 'Carousel Image 1 may not be greater than 2MB. Recommended size: 800x400 pixels.',
            'carousel_2.image' => 'Carousel Image 2 must be an image file.',
            'carousel_2.mimes' => 'Carousel Image 2 must be a file of type: jpeg, png, jpg, webp.',
            'carousel_2.max' => 'Carousel Image 2 may not be greater than 2MB. Recommended size: 800x400 pixels.',
            'carousel_3.image' => 'Carousel Image 3 must be an image file.',
            'carousel_3.mimes' => 'Carousel Image 3 must be a file of type: jpeg, png, jpg, webp.',
            'carousel_3.max' => 'Carousel Image 3 may not be greater than 2MB. Recommended size: 800x400 pixels.',
            'carousel_4.image' => 'Carousel Image 4 must be an image file.',
            'carousel_4.mimes' => 'Carousel Image 4 must be a file of type: jpeg, png, jpg, webp.',
            'carousel_4.max' => 'Carousel Image 4 may not be greater than 2MB. Recommended size: 800x400 pixels.',
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
        
        // Handle carousel images
        for ($i = 1; $i <= 4; $i++) {
            $fieldName = 'carousel_' . $i;
            if ($request->hasFile($fieldName)) {
                // Delete old file if exists
                if ($advertisement->$fieldName) {
                    Storage::delete('public/advertisements/' . $advertisement->$fieldName);
                }
                
                $file = $request->file($fieldName);
                $extension = $file->extension();
                $name = $fieldName . '.' . $extension;
                $file->storeAs('public/advertisements', $name);
                $advertisement->$fieldName = $name;
            }
        }
        
        $advertisement->save();

        return redirect()->back()->with('success', 'Advertisements updated successfully.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'ad_type' => 'required|string'
        ]);

        $advertisement = Advertisement::getOrCreate();
        $adType = $request->input('ad_type');

        // Handle removal based on ad type
        switch ($adType) {
            case 'advertisement_1':
                if ($advertisement->advertisement_1) {
                    Storage::delete('public/advertisements/' . $advertisement->advertisement_1);
                    $advertisement->advertisement_1 = null;
                }
                break;
                
            case 'carousel_1':
            case 'carousel_2':
            case 'carousel_3':
            case 'carousel_4':
                if ($advertisement->$adType) {
                    Storage::delete('public/advertisements/' . $advertisement->$adType);
                    $advertisement->$adType = null;
                }
                break;
                
            default:
                return redirect()->back()->with('error', 'Invalid advertisement type.');
        }

        $advertisement->save();

        return redirect()->back()->with('success', 'Advertisement removed successfully.');
    }
}
