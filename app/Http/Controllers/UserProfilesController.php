<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Caste;
use App\Models\Package;
use App\Models\Profile;
use App\Models\SubCaste;
use Illuminate\Http\Request;
use App\Models\ProfilePackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Default\UpdateProfileRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class UserProfilesController extends Controller
{
    public function calculateProfileCompletion($user)
    {
        // Define the fields that contribute to profile completion
        $fields = [
            'first_name',
            'middle_name',
            'last_name',
            'mother_tongue',
            'native_place',
            'gender',
            'marital_status',
            'living_with',
            'blood_group',
            'height',
            'weight',
            'body_type',
            'complexion',
            'physical_abnormality',
            'spectacles',
            'lens',
            'eating_habits',
            'drinking_habits',
            'smoking_habits',
            'about_self',
            'img_1',
            'img_2',
            'img_3',
            'religion',
            'cast',
            'sub_cast',
            'gotra',
            'father_is_alive',
            'father_name',
            'father_occupation',
            'father_organization',
            'father_job_type',
            'mother_is_alive',
            'mother_name',
            'mother_occupation',
            'number_of_brothers_married',
            'number_of_brothers_unmarried',
            'brother_resident_place',
            'number_of_sisters_married',
            'number_of_sisters_unmarried',
            'sister_resident_place',
            'about_parents',
            'date_of_birth',
            'birth_time',
            'birth_place',
            'highest_education',
            'education_in_detail',
            'additional_degree',
            'occupation',
            'organization',
            'designation',
            'job_location',
            'job_experience',
            'income',
            'currency',
            'country',
            'state',
            'city',
            'address_line_1',
            'address_line_2',
            'landmark',
            'pincode',
            'mobile',
            'landline',
            'email',
            'partner_min_age',
            'partner_max_age',
            'partner_min_height',
            'partner_max_height',
            'partner_income',
            'partner_currency',
            'want_to_see_patrika',
            'partner_sub_cast',
            'partner_eating_habbit',
            'partner_city_preference',
            'partner_education',
            'partner_education_specialization',
            'partner_job',
            'partner_business',
            'partner_foreign_resident',
        ];

        // Count how many of these fields are filled
        $filledFields = 0;
        foreach ($fields as $field) {
            if (!empty($user->$field)) {
                $filledFields++;
            }
        }

        // Calculate the completion percentage
        $totalFields = count($fields);
        $completionPercentage = ($filledFields / $totalFields) * 100;

        return round($completionPercentage);  // Return rounded completion percentage
    }

    public function search(Request $request)
    {
        // Enable DB query logging to debug the issue
        DB::enableQueryLog();
        
        // Get the search inputs
        $query = $request->input('query');
        $from_age = $request->input('from_age');
        $to_age = $request->input('to_age');
        $marital_status = $request->input('marital_status');
        $castes = $request->input('caste');
        $from_height = $request->input('from_height');
        $to_height = $request->input('to_height');
        $Castes = Caste::all();
        $SubCastes = SubCaste::all();
        $Subcastes = $request->input('Subcastes');
        $eating_habits = $request->input('eating_habits');
        $country = $request->input('country');
        $state = $request->input('state');
        $highest_education = $request->input('highest_education');
        $income = $request->input('income');    

        $users = Profile::query()
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->where('users.active', 1)
            ->select('profiles.*');

        if ($query) {
            $users->where(function ($queryBuilder) use ($query) {
                $queryBuilder
                    ->where('first_name', 'like', '%' . $query . '%')
                     ->orWhere('last_name', 'like', '%' . $query . '%');
            });
        }

        
        if ($income) {
            // Convert income to a decimal for proper comparison
            $incomeValue = (float) $income;
            // Ensure we're comparing with numeric values in the database
            $users->where(function($query) use ($incomeValue) {
                // Handle both numeric and string income values
                $query->where('income', '<=', $incomeValue)
                      ->orWhere(DB::raw('CAST(income as DECIMAL(10,2))'), '<=', $incomeValue);
            });
        }

        
        
        

        // Filter by marital status if provided
        if ($marital_status) {
            $users->whereIn('marital_status', $marital_status);
        }

        

        // Apply age filtering by converting birthdate to age
        if ($from_age && $to_age) {
            $users
                ->whereNotNull('date_of_birth')  // Ensure users have a birthdate
                ->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN ? AND ?', [$from_age, $to_age]);
        }

        if ($castes) {
            // Ensure $castes is an array even if it's a single value
            if (!is_array($castes)) {
                $castes = [$castes];  // Convert the single value to an array
            }
            $users->whereIn('caste', $castes);
        }
        if ($Subcastes) {
            // Ensure $castes is an array even if it's a single value
            if (!is_array($Subcastes)) {
                $Subcastes = [$Subcastes];  // Convert the single value to an array
            }
            $users->whereIn('sub_caste', $Subcastes);
        }

        if ($eating_habits) {
            // Ensure $eating_habits is an array even if it's a single value
            if (!is_array($eating_habits)) {
                $eating_habits = [$eating_habits];  // Convert the single value to an array
            }
            $users->whereIn('eating_habits', $eating_habits);
        }

        if ($country) {
            // Ensure $country is an array even if it's a single value
            if (!is_array($country)) {
                $country = [$country];  // Convert the single value to an array
            }
            $users->whereIn('country', $country);
        }

        if ($state) {
            // Ensure $state is an array even if it's a single value
            if (!is_array($state)) {
                $state = [$state];  // Convert the single value to an array
            }
            $users->whereIn('state', $state);
        }

        if ($highest_education) {
            // Ensure $highest_education is an array even if it's a single value
            if (!is_array($highest_education)) {
                $highest_education = [$highest_education];  // Convert the single value to an array
            }
            $users->whereIn('highest_education', $highest_education);
        }

        if ($from_height && $to_height) {
            $users
                ->whereNotNull('height')  // Ensure users have a height
                ->whereRaw('height BETWEEN ? AND ?', [$from_height, $to_height]);
        }

        // Fetch users from the database
        if (auth()->user()->profile->role === 'bride') {
            $users = $users->where('role', 'groom')->get();
        } elseif (auth()->user()->profile->role === 'groom') {
            $users = $users->where('role', 'bride')->get();
        }

        foreach ($users as $user) {
            $user->is_favorited = auth()->user()->profile->favoriteProfiles()->where('favorite_profile_id', $user->id)->exists();
        }

        // Convert birthdate to age for each user, handling null or invalid birthdates
        foreach ($users as $user) {
            if ($user->date_of_birth) {
                try {
                    $user->age = Carbon::parse($user->date_of_birth)->age;
                } catch (\Exception $e) {
                    $user->age = 'Unknown';  // Handle invalid dates
                }
            } else {
                $user->age = 'Unknown';  // Handle users without a birthdate
            }
        }

        // If no filters applied, show random 10 users
        if (empty($query) && empty($from_age) && empty($to_age) && empty($marital_status)) {
            if (auth()->user()->profile->role === 'bride') {
                $users = Profile::query()
                    ->join('users', 'profiles.user_id', '=', 'users.id')
                    ->where('users.active', 1)
                    ->select('profiles.*')
                    ->where('role', 'groom')
                    ->get()
                    ->shuffle()
                    ->take(11);
            } elseif (auth()->user()->profile->role === 'groom') {
                $users = Profile::query()
                    ->join('users', 'profiles.user_id', '=', 'users.id')
                    ->where('users.active', 1)
                    ->select('profiles.*')
                    ->where('role', 'bride')
                    ->get()
                    ->shuffle()
                    ->take(11);
            }
            
            foreach ($users as $user) {
                $user->is_favorited = auth()->user()->profile->favoriteProfiles()->where('favorite_profile_id', $user->id)->exists();
            }
        }

        // Log the executed queries for debugging
        $queries = DB::getQueryLog();
        Log::info('Search Queries:', $queries);

        // Return the filtered users to the view
        return view('default.view.profile.search.create', [
            'users' => $users,
            'Caste' => $Castes,
            'SubCaste' => $SubCastes,
        ]);
    }

    public function view_profile()
    {
        $profiles = Profile::all();
        $user = auth()->user()->profile()->first();
        $profileCompletion = $this->calculateProfileCompletion($user);
        $castes = Caste::find($user->caste);
        $subCastes = SubCaste::find($user->sub_caste);
        if ($subCastes){
            $subCastes = $subCastes->name; 
        };

        if ($castes){
            $castes = $castes->name; 
        };
       
        return view('default.view.profile.view_profile.create', ['subCastes' => $subCastes, 'castes' => $castes, 'user' => $user, 'profiles' => $profiles, 'profileCompletion' => $profileCompletion]);
    }

    public function basic_details(Request $request)
    {
        $user = auth()->user()->profile()->first();
        $profileCompletion = $this->calculateProfileCompletion($user);
    
        // Get the most recent active package
        $latest_package = ProfilePackage::where('profile_id', $user->id)
            ->where('expires_at', '>', now())
            ->orderBy('starts_at', 'desc')
            ->first();
    
        // Update profile's package_id with the latest active package
        if ($latest_package) {
            $user->update([
                'profile_package_id' => $latest_package->package_id
            ]);
        }
    
        // Retrieve all purchased packages
        $purchased_packages = auth()
            ->user()
            ->profile
            ->profilePackages()
            ->withPivot('tokens_received', 'tokens_used', 'starts_at', 'expires_at')
            ->where('expires_at', '>', now())
            ->get();
    
        $packages = Package::all();
    
        return view('default.view.profile.basic_details.index', [
            'user'              => $user,
            'profileCompletion' => $profileCompletion,
            'packages'          => $packages,
            'purchased_packages'=> $purchased_packages
        ]);
    }


    public function basic_details_store(Request $request)
    {
        $profile = Profile::where('user_id', auth()->user()->id)->first();

        // Handle image removal requests
        if ($request->has('remove_img_1')) {
            if (!empty($profile->img_1) && Storage::exists('public/images/'.$profile->img_1)) {
                Storage::delete('public/images/'.$profile->img_1);
                $profile->update(['img_1' => null]);
            }
            return redirect()->back()->with('success', 'Photo 1 removed successfully!');
        }

        if ($request->has('remove_img_2')) {
            if (!empty($profile->img_2) && Storage::exists('public/images/'.$profile->img_2)) {
                Storage::delete('public/images/'.$profile->img_2);
                $profile->update(['img_2' => null]);
            }
            return redirect()->back()->with('success', 'Photo 2 removed successfully!');
        }

        if ($request->has('remove_img_3')) {
            if (!empty($profile->img_3) && Storage::exists('public/images/'.$profile->img_3)) {
                Storage::delete('public/images/'.$profile->img_3);
                $profile->update(['img_3' => null]);
            }
            return redirect()->back()->with('success', 'Photo 3 removed successfully!');
        }

        $profile_pics = auth()->user()->profile->img_1;
        $rules = [
            'first_name' => 'required|string|max:100',
            'middle_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'mother_tongue' => 'required|string|max:100',
            'native_place' => 'required|string|max:100',
            'gender' => 'required|string|max:50',
            'marital_status' => 'required|string|max:50',
            'living_with' => 'required|string|max:100',
            'blood_group' => 'required|string|max:10',
            'height' => 'required|string|max:10',
            'weight' => 'required|string|max:10',
            'body_type' => 'required|string|max:50',
            'complexion' => 'required|string|max:50',
            'physical_abnormality' => 'required|boolean',
            'spectacles' => 'nullable|boolean',
            'lens' => 'nullable|boolean',
            'eating_habits' => 'nullable|string|max:100',
            'drinking_habits' => 'nullable|string|max:100',
            'smoking_habits' => 'nullable|string|max:100',
            'about_self' => 'nullable|string',
            'img_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        if ($profile_pics) {
            // If profile exists, make img_1 nullable
            $rules['img_1'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If profile does not exist, img_1 is required
            $rules['img_1'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validated = $request->validate($rules);
        $data = $validated;
        // dd($data);
        // Check if 'img_1' is uploaded and process
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

        // Repeat similar process for 'img_2' and 'img_3'

        // Check if 'img_2' is uploaded and process
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

        // Check if 'img_3' is uploaded and process
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

        if ($request->hasFile('img_2')) {
            $data['img_2'] = $img_2FileNameToStore;
        }

        if ($request->hasFile('img_3')) {
            $data['img_3'] = $img_3FileNameToStore;
        }

        if ($profile) {
            $profile->update($data);
        } else {
            return redirect()->back()->with('error', 'Profile not found.');
        }

        if ($request->filled('redirect_url')) {
            return redirect($request->redirect_url)->with('success', 'Profile updated successfully!');
        }
    

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function religious_details()
    {
        $user = auth()->user()->profile()->first();
        $title = 'Religious Details';
        $castes = Caste::all();
        $subCastes = SubCaste::all();
        $profileCompletion = $this->calculateProfileCompletion($user);
        return view('default.view.profile.religious_details.create', ['user' => $user, 'castes' => $castes, 'subCastes' => $subCastes, 'profileCompletion' => $profileCompletion, 'title' => $title]);
    }

    public function religious_details_store(Request $request)
    {
        // Get Other caste and subcaste IDs for validation
        $otherCasteId = Caste::where('name', 'Other')->first()?->id;
        $otherSubCasteIds = SubCaste::where('name', 'Other')->pluck('id')->toArray();
        
        $validationRules = [
            'religion' => 'nullable|string|max:100',
            'caste' => 'nullable|integer',
            'sub_caste' => 'nullable|integer',
            'gotra' => 'nullable|string|max:100',
            'custom_caste' => ['nullable', 'string', 'max:100'],
            'custom_sub_caste' => ['nullable', 'string', 'max:100'],
        ];
        
        // Add conditional validation for custom fields
        if ($otherCasteId && $request->caste == $otherCasteId) {
            $validationRules['custom_caste'][] = 'required';
        }
        
        if (!empty($otherSubCasteIds) && in_array($request->sub_caste, $otherSubCasteIds)) {
            $validationRules['custom_sub_caste'][] = 'required';
        }
        
        $validated = $request->validate($validationRules);
        $data = $validated;

        $profile = Profile::where('user_id', auth()->user()->id)->first();
        if ($profile) {
            $profile->update($data);
        } else {
            return redirect()->back()->with('error', 'Profile not found.');
        }
         // Check if a redirect URL was provided
    if ($request->filled('redirect_url')) {
        return redirect($request->redirect_url)->with('success', 'Profile updated successfully!');
    }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function family_details()
    {
        $user = auth()->user()->profile()->first();
        $profileCompletion = $this->calculateProfileCompletion($user);
        return view('default.view.profile.family_details.create', ['user' => $user, 'profileCompletion' => $profileCompletion]);
    }

    public function family_details_store(Request $request)
    {
        $validated = $request->validate([
            'father_is_alive' => 'nullable|boolean',
            'father_name' => 'nullable|string|max:100',
            'father_occupation' => 'nullable|string|max:100',
            'father_job_type' => 'nullable|string|max:100',
            'father_organization' => 'nullable|string|max:100',
            'father_mobile' => 'nullable|string|max:20',
            'father_address' => 'nullable|string',
            'mother_is_alive' => 'nullable|boolean',
            'mother_name' => 'nullable|string|max:100',
            'mother_occupation' => 'nullable|string|max:100',
            'mother_job_type' => 'nullable|string|max:100',
            'mother_organization' => 'nullable|string|max:100',
            'mother_mobile' => 'nullable|string|max:20',
            'mother_address' => 'nullable|string',
            'mother_native_place' => 'nullable|string|max:100',
            'mother_name_before_marriage' => 'nullable|string|max:100',
            'brother_resident_place' => 'nullable|string|max:100',
            'number_of_brothers_married' => 'nullable|integer|min:0|max:10',
            'number_of_brothers_unmarried' => 'nullable|integer|min:0|max:10',
            'sister_resident_place' => 'nullable|string|max:100',
            'number_of_sisters_married' => 'nullable|integer|min:0|max:10',
            'number_of_sisters_unmarried' => 'nullable|integer|min:0|max:10',
            'about_parents' => 'nullable|string',
        ]);
        $data = $validated;

        $profile = Profile::where('user_id', auth()->user()->id)->first();
        if ($profile) {
            $profile->update($data);
        } else {
            return redirect()->back()->with('error', 'Profile not found.');
        }

        if ($request->filled('redirect_url')) {
            return redirect($request->redirect_url)->with('success', 'Profile updated successfully!');
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function astronomy_details()
    {
        $user = auth()->user()->profile()->first();
        if ($user && $user->celestial_bodies) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies = explode(',', $user->celestial_bodies);
        } else {
            $storedCelestialBodies = [];
        }

        if ($user && $user->celestial_bodies_2) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies2 = explode(',', $user->celestial_bodies_2);
        } else {
            $storedCelestialBodies2 = [];
        }

        if ($user && $user->celestial_bodies_3) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies3 = explode(',', $user->celestial_bodies_3);
        } else {
            $storedCelestialBodies3 = [];
        }

        if ($user && $user->celestial_bodies_4) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies4 = explode(',', $user->celestial_bodies_4);
        } else {
            $storedCelestialBodies4 = [];
        }

        if ($user && $user->celestial_bodies_5) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies5 = explode(',', $user->celestial_bodies_5);
        } else {
            $storedCelestialBodies5 = [];
        }

        if ($user && $user->celestial_bodies_6) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies6 = explode(',', $user->celestial_bodies_6);
        } else {
            $storedCelestialBodies6 = [];
        }

        if ($user && $user->celestial_bodies_7) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies7 = explode(',', $user->celestial_bodies_7);
        } else {
            $storedCelestialBodies7 = [];
        }

        if ($user && $user->celestial_bodies_8) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies8 = explode(',', $user->celestial_bodies_8);
        } else {
            $storedCelestialBodies8 = [];
        }

        if ($user && $user->celestial_bodies_9) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies9 = explode(',', $user->celestial_bodies_9);
        } else {
            $storedCelestialBodies9 = [];
        }

        if ($user && $user->celestial_bodies_10) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies10 = explode(',', $user->celestial_bodies_10);
        } else {
            $storedCelestialBodies10 = [];
        }

        if ($user && $user->celestial_bodies_11) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies11 = explode(',', $user->celestial_bodies_11);
        } else {
            $storedCelestialBodies11 = [];
        }

        if ($user && $user->celestial_bodies_12) {
            // If stored as a comma-separated string, convert it into an array
            $storedCelestialBodies12 = explode(',', $user->celestial_bodies_12);
        } else {
            $storedCelestialBodies12 = [];
        }


        $profileCompletion = $this->calculateProfileCompletion($user);
        return view('default.view.profile.astronomy_details.create',
         ['user' => $user,
          'profileCompletion' => $profileCompletion,
        'storedCelestialBodies'=>$storedCelestialBodies,
        'storedCelestialBodies2'=>$storedCelestialBodies2,
        'storedCelestialBodies3'=>$storedCelestialBodies3,
        'storedCelestialBodies4'=>$storedCelestialBodies4,
        'storedCelestialBodies5'=>$storedCelestialBodies5,
        'storedCelestialBodies6'=>$storedCelestialBodies6,
        'storedCelestialBodies7'=>$storedCelestialBodies7,
        'storedCelestialBodies8'=>$storedCelestialBodies8,
        'storedCelestialBodies9'=>$storedCelestialBodies9,
        'storedCelestialBodies10'=>$storedCelestialBodies10,
        'storedCelestialBodies11'=>$storedCelestialBodies11,
        'storedCelestialBodies12'=>$storedCelestialBodies12,        
        ]);
    }

    public function astronomy_details_store(Request $request)
    {
        $profile = Profile::where('user_id', auth()->user()->id)->first();

        // Validate input data
        $validated = $request->validate([
            'birth_place' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'birth_time' => 'nullable|string|max:50',
            'when_meet' => 'nullable|boolean',
            'rashee' => 'nullable|string|max:50',
            'nakshatra' => 'nullable|string|max:50',
            'mangal' => 'nullable|string|max:50',
            'charan' => 'nullable|string|max:50',
            'gana' => 'nullable|string|max:50',
            'nadi' => 'nullable|string|max:50',
            'chart' => 'nullable|string|max:50',
            'more_about_patrika' => 'nullable|string',
            // 'celestial_bodies' => 'nullable|string|max:50',
            'img_patrika' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $validated;
        $celestial_bodies = implode(',', $request->input('celestial_bodies', []));
        $data['celestial_bodies'] = $celestial_bodies;

        $celestial_bodies2 = implode(',', $request->input('celestial_bodies_2', []));
        $data['celestial_bodies_2'] = $celestial_bodies2;
        
        $celestial_bodies3 = implode(',', $request->input('celestial_bodies_3', []));
        $data['celestial_bodies_3'] = $celestial_bodies3;

        $celestial_bodies4 = implode(',', $request->input('celestial_bodies_4', []));
        $data['celestial_bodies_4'] = $celestial_bodies4;

        $celestial_bodies5 = implode(',', $request->input('celestial_bodies_5', []));
        $data['celestial_bodies_5'] = $celestial_bodies5;

        $celestial_bodies6 = implode(',', $request->input('celestial_bodies_6', []));
        $data['celestial_bodies_6'] = $celestial_bodies6;

        $celestial_bodies7 = implode(',', $request->input('celestial_bodies_7', []));
        $data['celestial_bodies_7'] = $celestial_bodies7;

        $celestial_bodies8 = implode(',', $request->input('celestial_bodies_8', []));
        $data['celestial_bodies_8'] = $celestial_bodies8;

        $celestial_bodies9 = implode(',', $request->input('celestial_bodies_9', []));
        $data['celestial_bodies_9'] = $celestial_bodies9;

        $celestial_bodies10 = implode(',', $request->input('celestial_bodies_10', []));
        $data['celestial_bodies_10'] = $celestial_bodies10;

        $celestial_bodies11 = implode(',', $request->input('celestial_bodies_11', []));
        $data['celestial_bodies_11'] = $celestial_bodies11;

        $celestial_bodies12 = implode(',', $request->input('celestial_bodies_12', []));
        $data['celestial_bodies_12'] = $celestial_bodies12;
        
        if ($request->hasFile('img_patrika')) {
            
            if (!empty($profile->img_patrika) && Storage::exists('public/images/' . $profile->img_patrika)) {
                Storage::delete('public/images/'.$profile->img_patrika);
            }
            // Get the uploaded image file details
            $img_patrikaFileNameWithExtention = $request->file('img_patrika')->getClientOriginalName();
            $img_patrikaFilename = pathinfo($img_patrikaFileNameWithExtention, PATHINFO_FILENAME);
            $img_patrikaExtention = $request->file('img_patrika')->getClientOriginalExtension();
            $img_patrikaFileNameToStore = $img_patrikaFilename . '_' . time() . '.' . $img_patrikaExtention;

            // Store the image in the 'public/images' directory
            $img_patrikaPath = $request->file('img_patrika')->storeAs('public/images', $img_patrikaFileNameToStore);

            //  GD library to add text to the image
            $imagePath = storage_path('app/public/images/' . $img_patrikaFileNameToStore);

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
            $fontSize = 40;  // Font size (adjust to fit the image size)

            // Text to overlay
            $text = 'Aditya Matrimony';

            // Get the image dimensions
            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);

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

            // Optionally, you can add multiple shadow layers with different offsets to give even more depth.
            // JPEG format use imagepng or imagegif for PNG or GIF imagejpeg
            imagejpeg($image, $imagePath);
            // delete the image
            imagedestroy($image);
            // Assign the image name to the data array
            $data['img_patrika'] = $img_patrikaFileNameToStore;
        }

        // Update or create profile data
        if ($profile) {
            $profile->update($data);
        } else {
            return redirect()->back()->with('error', 'Profile not found.');
        }
        if ($request->filled('redirect_url')) {
            return redirect($request->redirect_url)->with('success', 'Profile updated successfully!');
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function educational_details()
    {
        $user = auth()->user()->profile()->first();
        $profileCompletion = $this->calculateProfileCompletion($user);
        return view('default.view.profile.educational_details.create', ['user' => $user, 'profileCompletion' => $profileCompletion]);
    }

    public function educational_details_store(Request $request)
    {
        $validated = $request->validate([
            'highest_education' => 'required|string|max:100',  // Fixed typo here: 'required' instead of 'requried'
            'other_education' => 'nullable|string|max:255',
            // 'other_education' => 'required_if:highest_education,other|string|max:255',
            'education_in_detail' => 'nullable|string',
            'additional_degree' => 'nullable|string|max:100',
        ]);

        $data = $validated;

        $profile = Profile::where('user_id', auth()->user()->id)->first();
        if ($profile) {
            $profile->update($data);
        } else {
            return redirect()->back()->with('error', 'Profile not found.');
        }

        if ($request->filled('redirect_url')) {
            return redirect($request->redirect_url)->with('success', 'Profile updated successfully!');
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function occupation_details(Request $request)
    {
        $user = auth()->user()->profile()->first();
        // Assume your store/update logic is here to save the incoming changes
    
        // if ($request->filled('redirect_url')) {
        //     return redirect($request->redirect_url)->with('success', 'Profile updated successfully!');
        // }
        
        return view('default.view.profile.occupation_details.create', [
            'user' => $user, 
            'profileCompletion' => $this->calculateProfileCompletion($user)
        ]);
    }

    public function occupation_details_store(Request $request)
    {
        $validated = $request->validate([
            'occupation' => 'required|string|max:100',   
            'organization' => 'nullable|string|max:255',
             'designation' => 'nullable|string',
            'job_location' => 'nullable|string|max:100',
            'income' => 'nullable|string|max:100',
            'job_experience' => 'nullable|string|max:100',
        ]);

        $data = $validated;

        $profile = Profile::where('user_id', auth()->user()->id)->first();
        if ($profile) {
            $profile->update($data);
        } else {
            return redirect()->back()->with('error', 'Profile not found.');
        }

        if ($request->filled('redirect_url')) {
            return redirect($request->redirect_url)->with('success', 'Profile updated successfully!');
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    

    public function contact_details()
    {
        $user = auth()->user()->profile()->first();
        $profileCompletion = $this->calculateProfileCompletion($user);

        return view('default.view.profile.contact_details.create', ['user' => $user, 'profileCompletion' => $profileCompletion]);
    }

    public function life_partner()
    {
        $user = auth()->user()->profile()->first();
        $profileCompletion = $this->calculateProfileCompletion($user);
        return view('default.view.profile.life_partner.create', ['user' => $user, 'profileCompletion' => $profileCompletion]);
    }

   

    public function user_packages()
    {
        $user = auth()->user()->profile()->first();
        $purchased_packages = auth()
            ->user()
            ->profile
            ->profilePackages()
            ->withPivot('tokens_received', 'tokens_used', 'starts_at', 'expires_at')
            ->where('expires_at', '>', now())
            ->get();

        $packages = Package::all();
        return view('default.view.profile.user_packages.create', [
            'user' => $user, 
            'packages' => $packages, 
            'purchased_packages' => $purchased_packages
        ]);
    }

    // Add new method for invoice generation
    public function generateInvoice($packageId)
    {
        $package = Package::findOrFail($packageId);
        $user = auth()->user()->profile()->first();
        
        $pdf = PDF::loadView('default.view.profile.user_packages.invoice', [
            'package' => $package,
            'user' => $user,
            'invoiceDate' => now(),
            'invoiceNumber' => 'INV-' . time()
        ]);
    
        return $pdf->stream('invoice-'.$package->name.'.pdf');
    }

    public function show($id)
    {
        // Find the user by ID
        $user = Profile::findOrFail($id);
        
        // Check if the user associated with this profile is active
        $isActive = User::where('id', $user->user_id)->where('active', 1)->exists();
        
        if (!$isActive) {
            return redirect()->back()->with('error', 'This profile is not active.');
        }
        
        $showButton = true;
         
        $castes = Caste::find($user->caste);
        $subCastes = SubCaste::find($user->sub_caste);
        if ($subCastes){
            $subCastes = $subCastes->name; 
        };

        if ($castes){
            $castes = $castes->name; 
        };

        
        // $users = auth()->user()->profile->interestProfiles()->get();      
          $interestedUsers = auth()->user()->profile->interestProfiles()->get();
           foreach($interestedUsers as $intUsers){
            if($intUsers->id === $user->id){
                $showButton = false;
                return view('default.view.profile.other_view.create', [ 'user' => $user, 'showButton'=>$showButton, 'castes' => $castes, 'subCastes' => $subCastes]);   
            }
        } 
           
        // Return a view with the user's data
        return view('default.view.profile.other_view.create', ['user' => $user, 'showButton'=>$showButton, 'castes' => $castes, 'subCastes' => $subCastes]);
    }

    public function store(UpdateProfileRequest $request)
    {   
        $profile = Profile::where('user_id', auth()->user()->id)->first();
        $user = User::find($profile->user_id);
  
        if($request->has("email")){
            $user->email = $request->input("email");
            $user->save();
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
            $img_2FileNameWithExtention = $request->file('img_2')->getClientOriginalName();
            $img_2Filename = pathinfo($img_2FileNameWithExtention, PATHINFO_FILENAME);
            $img_2Extention = $request->file('img_2')->getClientOriginalExtension();
            $img_2FileNameToStore = $img_2Filename . '_' . time() . '.' . $img_2Extention;
            $img_2Path = $request->file('img_2')->storeAs('public/images', $img_2FileNameToStore);
        }

        if ($request->hasFile('img_3')) {
            $img_3FileNameWithExtention = $request->file('img_3')->getClientOriginalName();
            $img_3Filename = pathinfo($img_3FileNameWithExtention, PATHINFO_FILENAME);
            $img_3Extention = $request->file('img_3')->getClientOriginalExtension();
            $img_3FileNameToStore = $img_3Filename . '_' . time() . '.' . $img_3Extention;
            $img_3Path = $request->file('img_3')->storeAs('public/images', $img_3FileNameToStore);
        }

        $data = $request->validated();
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

        if ($request->filled('redirect_url')) {
            return redirect($request->redirect_url)->with('success', 'Profile updated successfully!');
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function add_favorite(Request $request)
    {
        $favUserId = $request->favorite_id;

        $favProfile = Profile::find($favUserId);
        if (!$favProfile) {
            return redirect()->back()->with('error', 'profile does not exists');
        }

        $profile = auth()->user()->profile;
        $profile->favoriteProfiles()->attach($favProfile->id);

        return response()->json(['message' => 'added to favorites']);

        // return redirect()->back()->with('success', 'profile added to favorites successfully');
    }

    public function remove_favorite(Request $request)
    {
        $favUserId = $request->favorite_id;

        $favProfile = Profile::find($favUserId);
        if (!$favProfile) {
            return redirect()->back()->with('error', 'profile does not exists');
        }

        $profile = auth()->user()->profile;
        $profile->favoriteProfiles()->detach($favProfile->id);

        if ($request->has('fav_page')) {
            return redirect()->back()->with('success', 'profile removed from favorites successfully');
        }
        return response()->json(['message' => 'removed from favorites']);
    }

    public function view_favorite()
    {
        $users = auth()->user()->profile->favoriteProfiles()
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->where('users.active', 1)
            ->select('profiles.*')
            ->get();

        return view('default.view.profile.view_favorites.index', ['users' => $users]);
    }

    
    public function update_password()
    {
        return view('default.view.profile.update_password.index');
    }





    public function updatePassword(User $user, Request $request)
    {
        // Validate input including the old password
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
    
        $user = auth()->user();
    
        // Check if the provided old password matches the current one
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('profiles.update_password')
                ->with('error', 'Your old password does not match our records.');
        }
    
        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('profiles.update_password')
               ->with('status', 'Password updated successfully.');
    }
    
    
    
    
    

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // Check if the token exists in the password_resets table
        $reset = DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'This password reset token is invalid.']);
        }

        // Update the user's password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Optionally, you can delete the token after it's used
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Password has been reset.');
    }

    public function showImages(string $filename)
    {
        Log::info('Requested image filename', ['filename' => $filename]);

        // Try different possible paths for images
        $possiblePaths = [
            'images/' . $filename,           // For profile images
            'advertisements/' . $filename,   // For advertisement images
        ];

        $path = null;
        foreach ($possiblePaths as $possiblePath) {
            if (Storage::disk('public')->exists($possiblePath)) {
                $path = $possiblePath;
                break;
            }
        }

        if (!$path) {
            Log::warning('Image not found in any path', [
                'filename' => $filename,
                'searched_paths' => $possiblePaths
            ]);
            return response()->json(['error' => 'Image not found.'], 404);
        }

        $file = Storage::disk('public')->get($path);
        $type = Storage::disk('public')->mimeType($path);

        return response($file, 200)
            ->header('Content-Type', $type)
            ->header('Cache-Control', 'public, max-age=3600'); // Cache for 1 hour
    }

    public function allPurchasedPackages()
    {
        $purchased_packages = auth()
            ->user()
            ->profile
            ->profilePackages()
            ->withPivot('tokens_received', 'tokens_used', 'starts_at', 'expires_at')
            ->where('expires_at', '>', now())
            ->get();

        return view('default.view.profile.user_packages.all_packages', [
            'purchased_packages' => $purchased_packages
        ]);
    }
}