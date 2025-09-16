<?php

namespace App\Http\Controllers\admin;

use Excel;
use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Caste;
use App\Models\Package;
use App\Models\Profile;
use App\Models\SubCaste;
use Illuminate\Http\Request;
use App\Models\ProfilePackage;
use Spatie\Permission\Models\Role;
use App\Imports\ImportUserProfiles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Default\UpdateProfileRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    

    public function index(Request $request)
    {
        $query = Profile::query()
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->select('profiles.*', 'users.email', 'users.mobile', 'users.active')
            ->orderByDesc('users.active')
            ->orderByDesc('profiles.id');

        // If logged in as franchise, filter profiles by franchise_code
        if (Auth::guard('franchise')->check()) {
            $franchise = Auth::guard('franchise')->user();
            $query->where('profiles.franchise_code', $franchise->franchise_code);
        }
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereRaw("CONCAT(COALESCE(profiles.first_name, ''), ' ', COALESCE(profiles.middle_name, ''), ' ', COALESCE(profiles.last_name, '')) LIKE ?", ["%{$search}%"])
                    ->orWhere('profiles.first_name', 'like', "%{$search}%")
                    ->orWhere('profiles.middle_name', 'like', "%{$search}%")
                    ->orWhere('profiles.last_name', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('users.mobile', 'like', "%{$search}%");
            });
        }
    
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('users.active', $status);
        }
        
    
        $profiles = $query->paginate(12);
    
        return view('admin.user_profiles.index', compact('profiles'));
    }
    
    
    
    

    public function edit(Profile $profile)
    {
        $castes = Caste::all();
        $subCastes = SubCaste::all();
        return view('admin.user_profiles.edit', ['profile' => $profile, 'castes' => $castes, 'subCastes' => $subCastes]);
    }

    // public function user_profiles()
    // {
    //     $user = auth()->user()->profile()->first();
    //     return view('admin.user_profiles.create', ['user' => $user]);
    // }


    public function update(Request $request, Profile $profile)
    {
        // dd($profile->id);
        // dd($request->all());
        
        // Check for "Other" caste/subcaste IDs and add validation rules accordingly
        $otherCasteId = Caste::where('name', 'Other')->value('id');
        $otherSubcasteId = SubCaste::where('name', 'Other')->value('id');
        
        $validationRules = [
            // Require at least one of email or mobile; allow both
            'email'  => 'nullable|required_without:mobile|email|max:100',
            'mobile' => 'nullable|required_without:email|string|max:20',
        ];
        
        // If "Other" caste is selected, require custom_caste
        if ($request->caste == $otherCasteId) {
            $validationRules['custom_caste'] = 'required|string|max:255';
        }
        
        // If "Other" subcaste is selected, require custom_sub_caste
        if ($request->sub_caste == $otherSubcasteId) {
            $validationRules['custom_sub_caste'] = 'required|string|max:255';
        }
        
        // Validate if there are any custom fields to validate
        if (!empty($validationRules)) {
            $request->validate($validationRules);
        }
        
        $data = $request->all();

        // Normalize mobile: keep last 10 digits and prefix +91
        if ($request->filled('mobile')) {
            $digits = preg_replace('/\D+/', '', $request->input('mobile'));
            if (strlen($digits) >= 10) {
                $last10 = substr($digits, -10);
                $data['mobile'] = '+91' . $last10;
            }
        }
        if ($request->hasFile('img_1')) {
            if (!empty($profile->img_1) && Storage::exists('public/images/'.$profile->img_1)) {
                Storage::delete('public/images/'.$profile->img_1);
            }

            // Get the uploaded image file details
            $img_1FileNameWithExtention = $request->file('img_1')->getClientOriginalName();
            $img_1Filename = pathinfo($img_1FileNameWithExtention, PATHINFO_FILENAME);
            $img_1Extention = $request->file('img_1')->getClientOriginalExtension();
            $img_1FileNameToStore = $img_1Filename . '_' . time() . '.' . $img_1Extention;

            // Store the image temporarily
            $img_1Path = $request->file('img_1')->storeAs('public/images', $img_1FileNameToStore);

            // Get the path to the uploaded image
            $imagePath = storage_path('app/public/images/' . $img_1FileNameToStore);

            // Open the uploaded image
            $image = imagecreatefromjpeg($imagePath);
            if ($image === false) {
                return redirect()->back()->with('error', 'Failed to open image.');
            }

            // Get the current image dimensions
            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);

            // Define the desired 5:7 aspect ratio
            $desiredAspectRatio = 5 / 7;

            // Resize logic for 5:7 ratio
            if ($imageWidth / $imageHeight > $desiredAspectRatio) {
                // If width is too large for the 5:7 ratio, crop width
                $newWidth = $imageHeight * $desiredAspectRatio;
                $newHeight = $imageHeight;
            } else {
                // If height is too large for the 5:7 ratio, crop height
                $newWidth = $imageWidth;
                $newHeight = $imageWidth / $desiredAspectRatio;
            }

            // Crop the image to maintain the 5:7 ratio
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $imageWidth, $imageHeight);

            // Save the resized image
            imagejpeg($resizedImage, $imagePath);

            // Free up memory
            imagedestroy($image);
            imagedestroy($resizedImage);

            // Font and color for the text
            $fontPath = public_path('fonts/font-1.ttf');  // Ensure this is the correct path to your TTF font

            // Colors for text and shadow
            $shadowColor = imagecolorallocatealpha($image, 0, 0, 0, 50);  // Faded shadow
            $textColor = imagecolorallocatealpha($image, 255, 0, 0, 100);  // Faded text

            // Text to overlay
            $text = 'Aditya Matrimony';

            // Get the image dimensions again after resizing
            $imageWidth = imagesx($resizedImage);
            $imageHeight = imagesy($resizedImage);

            // Dynamically adjust the font size based on image dimensions
            $maxFontSize = 0;
            $fontSize = 1;  // Start with the smallest font size and increase it
            while ($fontSize < 100) {  // Maximum font size limit (adjust as needed)
                // Get the bounding box for the current font size
                $textBoundingBox = imagettfbbox($fontSize, 0, $fontPath, $text);
                $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                $textHeight = $textBoundingBox[1] - $textBoundingBox[7];

                // Check if the text fits within the image width and height
                if ($textWidth <= $imageWidth && $textHeight <= $imageHeight) {
                    $maxFontSize = $fontSize;  // Store the last valid font size
                } else {
                    break;  // Exit the loop if the text doesn't fit
                }

                $fontSize++;
            }

            // Calculate the text position (center it on the image)
            $textBoundingBox = imagettfbbox($maxFontSize, 0, $fontPath, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $textHeight = $textBoundingBox[1] - $textBoundingBox[7];

            $x = ($imageWidth - $textWidth) / 2;  // Center the text horizontally
            $y = ($imageHeight - $textHeight) / 2 + $textHeight;  // Center the text vertically

            // Ensure text is inside the image (if the calculated position is too close to the edge)
            if ($x < 0) {
                $x = 0;
            } elseif ($x + $textWidth > $imageWidth) {
                $x = $imageWidth - $textWidth;
            }

            if ($y < $textHeight) {
                $y = $textHeight;
            } elseif ($y + $textHeight > $imageHeight) {
                $y = $imageHeight - $textHeight;
            }

            // Add shadow layer
            $shadowOffsetX = 3;
            $shadowOffsetY = 3;

            // First, draw the shadow layer (text slightly offset)
            imagettftext($resizedImage, $maxFontSize, 0, $x + $shadowOffsetX, $y + $shadowOffsetY, $shadowColor, $fontPath, $text);

            // Then, draw the main text on top of the shadow
            imagettftext($resizedImage, $maxFontSize, 0, $x, $y, $textColor, $fontPath, $text);

            // Save the modified image
            imagejpeg($resizedImage, $imagePath);

            // Free up memory
            imagedestroy($resizedImage);

            // Assign the image name to the data array
            $data['img_1'] = $img_1FileNameToStore;
        }
        if ($request->hasFile('img_patrika')) {
            $img_patrikaFileNameWithExtention = $request->file('img_patrika')->getClientOriginalName();
            $img_patrikaFilename = pathinfo($img_patrikaFileNameWithExtention, PATHINFO_FILENAME);
            $img_patrikaExtention = $request->file('img_patrika')->getClientOriginalExtension();
            $img_patrikaFileNameToStore = $img_patrikaFilename . '_' . time() . '.' . $img_patrikaExtention;
            $img_patrikaPath = $request->file('img_patrika')->storeAs('public/images', $img_patrikaFileNameToStore);
        }

        if ($request->hasFile('img_2')) {
            if (!empty($profile->img_2) && Storage::exists('public/images/' . $profile->img_2)) {
                Storage::delete('public/images/' . $profile->img_2);
            }
            // Get the uploaded image file details
            $img_2FileNameWithExtention = $request->file('img_2')->getClientOriginalName();
            $img_2Filename = pathinfo($img_2FileNameWithExtention, PATHINFO_FILENAME);
            $img_2Extention = $request->file('img_2')->getClientOriginalExtension();
            $img_2FileNameToStore = $img_2Filename . '_' . time() . '.' . $img_2Extention;

            // Store the image in the 'public/images' directory
            $img_2Path = $request->file('img_2')->storeAs('public/images', $img_2FileNameToStore);

            // GD library to add text to the image
            $imagePath = storage_path('app/public/images/' . $img_2FileNameToStore);

            // Open the image file
            $image = imagecreatefromjpeg($imagePath);

            if ($image === false) {
                // Handle image opening failure
                return redirect()->back()->with('error', 'Failed to open image.');
            }

            // Font and color for the text
            $fontPath = public_path('fonts/font-1.ttf');  // Ensure this is the correct path to your TTF font

            // Colors for text and shadow (faded shadow effect)
            $shadowColor = imagecolorallocatealpha($image, 0, 0, 0, 50);  // Black color with alpha 50 (faded shadow)
            $textColor = imagecolorallocatealpha($image, 255, 0, 0, 100);  // Red color with alpha 100 (faded text)

            // Text to overlay
            $text = 'Aditya Matrimony';

            // Get the image dimensions
            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);

            // Dynamically adjust the font size based on the image size
            $fontSize = min($imageWidth, $imageHeight) / 10;  // Scale font size based on image size

            // Get the text dimensions
            $textBoundingBox = imagettfbbox($fontSize, 0, $fontPath, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $textHeight = $textBoundingBox[1] - $textBoundingBox[7];

            // Calculate the position to center the text
            $x = ($imageWidth - $textWidth) / 2;  // Center the text horizontally
            $y = ($imageHeight - $textHeight) / 2 + $textHeight;  // Center the text vertically

            // Add shadow layer to simulate 3D effect (slightly offset shadow)
            $shadowOffsetX = 3;  // Horizontal offset of shadow
            $shadowOffsetY = 3;  // Vertical offset of shadow

            // First, draw the shadow layer (text slightly offset)
            imagettftext($image, $fontSize, 0, $x + $shadowOffsetX, $y + $shadowOffsetY, $shadowColor, $fontPath, $text);

            // Then, draw the main text on top of the shadow
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $text);

            // Save the modified image (overwrites the original file)
            imagejpeg($image, $imagePath);

            // Free up memory after modifying the image
            imagedestroy($image);

            // Assign the image name to the data array
            $data['img_2'] = $img_2FileNameToStore;
        }

        if ($request->hasFile('img_3')) {
            if (!empty($profile->img_3) && Storage::exists('public/images/' . $profile->img_3)) {
                Storage::delete('public/images/' . $profile->img_3);
            }
            // Get the uploaded image file details
            $img_3FileNameWithExtention = $request->file('img_3')->getClientOriginalName();
            $img_3Filename = pathinfo($img_3FileNameWithExtention, PATHINFO_FILENAME);
            $img_3Extention = $request->file('img_3')->getClientOriginalExtension();
            $img_3FileNameToStore = $img_3Filename . '_' . time() . '.' . $img_3Extention;

            // Store the image in the 'public/images' directory
            $img_3Path = $request->file('img_3')->storeAs('public/images', $img_3FileNameToStore);

            // GD library to add text to the image
            $imagePath = storage_path('app/public/images/' . $img_3FileNameToStore);

            // Open the image file
            $image = imagecreatefromjpeg($imagePath);

            if ($image === false) {
                // Handle image opening failure
                return redirect()->back()->with('error', 'Failed to open image.');
            }

            // Font and color for the text
            $fontPath = public_path('fonts/font-1.ttf');  // Ensure this is the correct path to your TTF font

            // Colors for text and shadow (faded shadow effect)
            $shadowColor = imagecolorallocatealpha($image, 0, 0, 0, 50);  // Black color with alpha 50 (faded shadow)
            $textColor = imagecolorallocatealpha($image, 255, 0, 0, 100);  // Red color with alpha 100 (faded text)

            // Text to overlay
            $text = 'Aditya Matrimony';

            // Get the image dimensions
            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);

            // Dynamically adjust the font size based on the image size (for better scaling)
            $fontSize = min($imageWidth, $imageHeight) / 10;  // Font size based on the image's smallest dimension (adjust /10 to suit)

            // Get the text dimensions
            $textBoundingBox = imagettfbbox($fontSize, 0, $fontPath, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $textHeight = $textBoundingBox[1] - $textBoundingBox[7];

            // Calculate the position to center the text
            $x = ($imageWidth - $textWidth) / 2;  // Center the text horizontally
            $y = ($imageHeight - $textHeight) / 2 + $textHeight;  // Center the text vertically

            // Add shadow layer to simulate 3D effect (slightly offset shadow)
            $shadowOffsetX = 3;  // Horizontal offset of shadow
            $shadowOffsetY = 3;  // Vertical offset of shadow

            // First, draw the shadow layer (text slightly offset)
            imagettftext($image, $fontSize, 0, $x + $shadowOffsetX, $y + $shadowOffsetY, $shadowColor, $fontPath, $text);

            // Then, draw the main text on top of the shadow
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $text);

            // Save the modified image (overwrites the original file)
            imagejpeg($image, $imagePath);

            // Free up memory after modifying the image
            imagedestroy($image);

            // Assign the image name to the data array
            $data['img_3'] = $img_3FileNameToStore;
        }

        if ($request->hasFile('img_1')) {
            $data['img_1'] = $img_1FileNameToStore;
        }
        if ($request->hasFile('img_patrika')) {
            $data['img_patrika'] = $img_patrikaFileNameToStore;
        }

        if ($request->hasFile('img_2')) {
            $data['img_2'] = $img_2FileNameToStore;
        }

        if ($request->hasFile('img_3')) {
            $data['img_3'] = $img_3FileNameToStore;
        }
        $data['lens'] = $request->has('lens');
        $data['spectacles'] = $request->has('spectacles');

        if ($profile) {
            $profile->update($data);  // update() handles mass assignment based on fillable fields
        } else {
            return redirect()->back()->with('error', 'Profile not found.');
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    

    public function import()
    {
        return view('admin.user_profiles.import');
    }

    public function destroy(string $id)
    {
        // Authorization: Only allow deletion when an Admin (web guard) is logged in
        if (!(Auth::check() && Auth::user()->hasRole('admin'))) {
            return redirect()->back()->with('error', 'You do not have permission to delete profiles.');
        }

        // Find the profile by ID
        $profile = Profile::find($id);
    
        // Check if profile exists
        if (!$profile) {
            return redirect()->back()->with('error', 'Profile not found');
        }
    
        // Find the user associated with this profile
        $user = User::find($profile->user_id);
    
        // Check if user exists
        if ($user) {
            // Optional: Delete the profile if you want to delete the related profile as well
            // $profile->delete();
    
            // Delete the user
            $user->delete();
    
            // Redirect with success message
            return redirect('/user_profiles')->with('success', 'Profile deleted successfully');
        } else {
            // Handle case where user is not found
            return redirect()->back()->with('error', 'User associated with the profile not found');
        }
    }


    public function importUserProfilesExcel(Request $request)
    {
        try {
            Excel::import(new ImportUserProfiles, $request->file);
            $request->session()->flash('success', 'Excel imported successfully!');
            return redirect()->route('user_profiles.index');
        } catch (Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Export the filtered profiles list to PDF (franchise-aware)
     */
    public function exportPdf(Request $request)
    {
        // Build the same query as index(), including franchise scoping
        $query = Profile::query()
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->select('profiles.*', 'users.email', 'users.mobile', 'users.active')
            ->orderByDesc('users.active')
            ->orderByDesc('profiles.id');

        if (Auth::guard('franchise')->check()) {
            $franchise = Auth::guard('franchise')->user();
            $query->where('profiles.franchise_code', $franchise->franchise_code);
        }

        if ($request->has('search') && $request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereRaw("CONCAT(COALESCE(profiles.first_name, ''), ' ', COALESCE(profiles.middle_name, ''), ' ', COALESCE(profiles.last_name, '')) LIKE ?", ["%{$search}%"])
                  ->orWhere('profiles.first_name', 'like', "%{$search}%")
                  ->orWhere('profiles.middle_name', 'like', "%{$search}%")
                  ->orWhere('profiles.last_name', 'like', "%{$search}%")
                  ->orWhere('users.email', 'like', "%{$search}%")
                  ->orWhere('users.mobile', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('users.active', $status);
        }

        $profiles = $query->get();

        // Render the PDF view
        $pdf = Pdf::loadView('admin.user_profiles.list_pdf', [
            'profiles' => $profiles,
            'generatedAt' => now(),
        ]);

        $fileName = 'profiles-' . now()->format('Ymd-His') . '.pdf';
        return $pdf->download($fileName);
    }

    public function create()
    {
        // Retrieve available packages
        $packages = Package::all();
        
        return view('admin.user_profiles.create', compact('packages'));
    }

    /**
     * Store a newly created profile in storage.
     */
    public function store(Request $request)
{
    // If franchise logged in, auto-assign franchise_code
    if (Auth::guard('franchise')->check()) {
        $request->merge(['franchise_code' => Auth::guard('franchise')->user()->franchise_code]);
    }

    // Normalize mobile before validation
    $mobile = $request->input('mobile');
    if (strpos($mobile, '+91') !== 0) {
        $mobile = '+91' . $mobile;
    }
    $request->merge(['mobile' => $mobile]);

    $request->validate([
        'first_name' => [
            'required',
            'string',
            'max:100',
            // Custom duplicate check for full name
            function($attribute, $value, $fail) use ($request) {
                $exists = Profile::where('first_name', $value)
                    ->where('middle_name', $request->middle_name)
                    ->where('last_name', $request->last_name)
                    ->exists();
                if ($exists) {
                    $fail('A profile with the same full name already exists.');
                }
            },
        ],
        'middle_name' => 'nullable|string|max:100',
        'last_name'   => 'nullable|string|max:100',
        'role'        => 'required|in:bride,groom',
        'mobile'      => 'required|string|max:20|unique:users,mobile',
        'email'       => 'required|email|max:100|unique:users,email',
        'package_id'  => 'required|exists:packages,id',
    ]);

    // Derive gender from role (server-side enforcement)
    $gender = $request->role === 'groom' ? 'male' : 'female';

    // Create a new user with a fixed password "Aditya123"
    $user = User::create([
        'name'       => trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name),
        'first_name' => $request->first_name,
        'middle_name'=> $request->middle_name,
        'last_name'  => $request->last_name,
        'mobile'     => $mobile,  // now normalized
        'email'      => $request->email,
        'password'   => Hash::make('Aditya123'),
        'active'     => 1,
    ]);

    // Assign role based on the request value ('bride' or 'groom')
// Assign the 'member' role to the user for the guard 'web'
$user->assignRole('member');

    // Create the profile record
    $profile = Profile::create([
        'user_id'    => $user->id,
        'first_name' => $request->first_name,
        'middle_name'=> $request->middle_name,
        'last_name'  => $request->last_name,
        'role'       => $request->role,
        'gender'     => $gender,
        'mobile'     => $mobile,
        'email'      => $request->email,
        'franchise_code' => $request->franchise_code,
    ]);

    // Process package selection
    $package = Package::find($request->package_id);
    if ($package) {
        $tokens_received = $package->tokens;
        $starts_at = Carbon::now();
        $expires_at = $starts_at->copy()->addDays($package->validity ?? 30);

        // Create profile-package association
        ProfilePackage::create([
            'profile_id'      => $profile->id,
            'package_id'      => $package->id,
            'tokens_received' => $tokens_received,
            'starts_at'       => $starts_at,
            'expires_at'      => $expires_at,
        ]);

        // Update profile’s available tokens
        $profile->available_tokens = ($profile->available_tokens ?? 0) + $tokens_received;
        $profile->save();
    }

    return redirect()->route('user_profiles.index')
                     ->with('success', 'Profile added successfully!');
}

public function download($id)
{
    try {
        $profile = Profile::findOrFail($id);
        
        // Load the Blade view for PDF
        $pdf = Pdf::loadView('admin.user_profiles.pdf', compact('profile'));

        // Generate a dynamic filename - handle null middle names
        $nameParts = array_filter([
            $profile->first_name,
            $profile->middle_name,
            $profile->last_name
        ]);
        $filename = implode('.', $nameParts) . '(' . date('d-m-Y') . ').pdf';

        // Return the PDF as a download
        return $pdf->download($filename);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error generating PDF: ' . $e->getMessage());
    }
}

    /**
     * Download the latest invoice PDF for a user by profile
     */
    public function downloadInvoice($profileId)
    {
        try {
            $profile = Profile::findOrFail($profileId);
            
            if (empty($profile->profile_package_id)) {
                return redirect()->back()->with('error', 'No invoice available for this user.');
            }
            
            // Retrieve the purchased package with pivot data
            $package = $profile->profilePackages()
                ->wherePivot('id', $profile->profile_package_id)
                ->first();
                
            if (!$package) {
                return redirect()->back()->with('error', 'Package not found for this invoice.');
            }

            // Generate PDF using the invoice view
            $pdf = Pdf::loadView('default.view.profile.user_packages.invoice', [
                'package' => $package,
                'user' => $profile,
                'invoiceDate' => now(),
                'invoiceNumber' => 'INV-' . str_pad($profile->profile_package_id, 6, '0', STR_PAD_LEFT),
            ]);

            // Generate safe filename
            $filename = 'invoice-' . preg_replace('/[^a-zA-Z0-9-_]/', '', $package->name) . '-' . date('dmY') . '.pdf';
            
            // Download the generated PDF
            return $pdf->download($filename);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error generating invoice: ' . $e->getMessage());
        }
    }
}