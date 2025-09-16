<?php
namespace App\Imports;

use App\Models\User;
use App\Models\Profile;
use App\Models\Package;
use App\Models\ProfilePackage;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;

class ImportUserProfiles implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
{
/**
* Define the fields that you want to import.
* All fields are mandatory.
*/
public function rules(): array
{
return [
'first_name' => 'required|string|max:100',
'middle_name' => 'nullable|string|max:100',
'last_name' => 'nullable|string|max:100',
'type' => 'required|string|max:100',
// If email is not provided, mobile is required (and vice versa)
'mobile'      => [
    'required_without:email',
    'nullable',
    'max:20',
    function ($attribute, $value, $fail) {
        // If the mobile does not already start with '+91', prepend it.
        $mobile = (strpos($value, '+91') === 0) ? $value : '+91' . $value;
        // Check if a user already exists with the transformed mobile number.
        if (User::where('mobile', $mobile)->exists()) {
            $fail('Duplicate data found: This mobile number is already in use.');
        }
    }
],
'email' => 'required_without:mobile|nullable|email|max:100|unique:users,email',
'password' => 'nullable|string|min:6',
];
}

/**
* Set custom validation error messages, including for duplicate data.
*/
public function customValidationMessages(): array
{
return [
'*.first_name.required' => 'First Name is mandatory for every record.',
'*.type.required' => 'Role is mandatory for every record.',
'*.mobile.required_without' => 'Either Mobile or Email is required. If Email is not provided, Mobile is mandatory.',
'*.email.required_without' => 'Either Email or Mobile is required. If Mobile is not provided, Email is mandatory.',
'*.email.email' => 'Please provide a valid email address.',
'*.email.unique' => 'Duplicate data found: This email address is already in use.',
 ];
}

/**
* Create a new User instance using only the specified fields.
*/
public function model(array $row)
{
// Explicitly cast mobile to a string
$mobile = (string) $row['mobile'];
// If mobile doesn't already start with '+91', add it.
if (!empty($mobile) && substr($mobile, 0, 3) !== '+91') {
$mobile = '+91' . $mobile;
}

// Full Name which will store in the user table
$fullName = trim($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']);

$user = new User([
'name' => $fullName,
'first_name' => $row['first_name'],
'middle_name' => $row['middle_name'],
'last_name' => $row['last_name'],
'mobile' => $mobile,
'email' => $row['email'],
    'password' => Hash::make('Aditya123'), // Fixed password for all imports
'active' => 1,
]);
$user->save();
$user->assignRole('member');

// Create the profile
$profileData = [
'user_id' => $user->id,
'first_name' => $row['first_name'],
'middle_name' => $row['middle_name'],
'last_name' => $row['last_name'],
'role' => $row['type'],
'email' => $row['email'],
'mobile' => $mobile,
'franchise_code' => auth('franchise')->check() ? auth('franchise')->user()->franchise_code : ($row['franchise_code'] ?? null),
];
$profile = Profile::create($profileData);

// Retrieve the first package from the packages table.
$package = Package::first();
if ($package) {
// Get the tokens received from the package (assumes package model has a tokens attribute).
$tokens_received = $package->tokens;
// The start date is the current time.
$starts_at = Carbon::now();
// The expires_at is calculated based on the package validity (in days). Defaults to 30 days if not set.
$expires_at = $starts_at->copy()->addDays($package->validity ?? 30);

// Create the profile-package association with tokens, starts_at, and expires_at.
ProfilePackage::create([
'profile_id' => $profile->id,
'package_id' => $package->id,
'tokens_received' => $tokens_received,
'starts_at' => $starts_at,
'expires_at' => $expires_at,
]);

// Update the profile's available_tokens by adding the tokens_received
$profile->available_tokens = ($profile->available_tokens ?? 0) + $tokens_received;
$profile->save();
}

// Return null to prevent Laravel Excel from saving the model again
return null;
}

public function batchSize(): int
{
return 500;
}

public function chunkSize(): int
{
return 500;
}
}