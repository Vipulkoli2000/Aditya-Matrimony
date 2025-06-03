<?php
namespace App\Imports;
use Log;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Package;
use App\Models\Profile;
use App\Models\Employee;
use App\Models\Stockist;
use App\Models\ProfilePackage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportUserProfiles implements ToModel,WithHeadingRow,WithValidation, WithBatchInserts, WithChunkReading
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function rules(): array
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'first_name' => 'nullable|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'mother_tongue' => 'nullable|string|max:100',
            'native_place' => 'nullable|string|max:100',
            'gender' => 'nullable|string|max:50',
            'marital_status' => 'nullable|string|max:50',
            'living_with' => 'nullable|string|max:100',
            'available_tokens' => 'nullable|integer|min:0',
            'blood_group' => 'nullable|string|max:10',
            'height' => 'nullable|string|max:10',
            'weight' => 'nullable|max:10',
            'body_type' => 'nullable|string|max:50',
            'complexion' => 'nullable|string|max:50',
            'physical_abnormality' => 'nullable|boolean',
            'spectacles' => 'nullable|boolean',
            'lens' => 'nullable|boolean',
            'eating_habits' => 'nullable|string|max:100',
            'drinking_habits' => 'nullable|string|max:100',
            'smoking_habits' => 'nullable|string|max:100',
            'about_self' => 'nullable|string',
            'religion' => 'nullable|string|max:100',
            'caste' => 'nullable|string',
            'sub_caste' => 'nullable|string',
            'gotra' => 'nullable|string|max:100',
            'father_is_alive' => 'nullable|boolean',
            'father_name' => 'nullable|string|max:100',
            'father_occupation' => 'nullable|string|max:100',
            'father_organization' => 'nullable|string|max:100',
            'father_job_type' => 'nullable|string|max:100',
            'mother_is_alive' => 'nullable|boolean',
            'mother_name' => 'nullable|string|max:100',
            'mother_occupation' => 'nullable|string|max:100',
            'mother_organization' => 'nullable|string|max:100',
            'mother_job_type' => 'nullable|string|max:100',
            'number_of_brothers_married' => 'nullable|integer',
            'number_of_brothers_unmarried' => 'nullable|integer',
            'brother_resident_place' => 'nullable|string|max:100',
            'number_of_sisters_married' => 'nullable|integer',
            'number_of_sisters_unmarried' => 'nullable|integer',
            'sister_resident_place' => 'nullable|string|max:100',
            'about_parents' => 'nullable|string',
            'date_of_birth' => 'nullable',
            'birth_time' => 'nullable|max:505',
            'birth_place' => 'nullable|string|max:100',
            'highest_education' => 'nullable|string|max:100',
            'education_in_detail' => 'nullable|string',
            'additional_degree' => 'nullable|string|max:100',
            'other_education' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',
            'organization' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:100',
            'job_location' => 'nullable|string|max:100',
            'job_experience' => 'nullable|max:100',
            'income' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'address_line_1' => 'nullable|string',
            'address_line_2' => 'nullable|string',
            'landmark' => 'nullable|string|max:100',
            'pincode' => 'nullable|max:20',
            'mobile' => 'nullable|max:20',
            'landline' => 'nullable|max:15',
            'email' => 'nullable|email|max:100|unique:profiles,email',
            'partner_min_age' => 'nullable|integer|min:0',
            'partner_max_age' => 'nullable|integer|min:0',
            'partner_min_height' => 'nullable|string|max:50',
            'partner_max_height' => 'nullable|string|max:50',
            'partner_income' => 'nullable|numeric|min:0',
            'partner_currency' => 'nullable|string|max:50',
            'want_to_see_patrika' => 'nullable|max:100',
            'partner_sub_cast' => 'nullable|string|max:100',
            'partner_eating_habbit' => 'nullable|string|max:100',
            'partner_city_preference' => 'nullable|string|max:100',
            'partner_education' => 'nullable|string|max:100',
            'partner_education_specialization' => 'nullable|string|max:100',
            'partner_job' => 'nullable|string|max:100',
            'partner_business' => 'nullable|string|max:100',
            'partner_foreign_resident' => 'nullable|string|max:100',
            'when_meet' => 'nullable|boolean',
            'rashee' => 'nullable|string|max:50',
            'nakshatra' => 'nullable|string|max:50',
            'mangal' => 'nullable|string|max:50',
            'charan' => 'nullable|string|max:50',
            'gana' => 'nullable|string|max:50',
            'nadi' => 'nullable|string|max:50',
            'chart' => 'nullable|max:50',
            'more_about_patrika' => 'nullable|string',
        ];
    }
    
    public function customValidationMessages()
    {
        return [
            // 'stockist.unique' => 'Stockists Already Exist',
        ];
    }
    
    public function model(array $row)
    {
       
        // $sub_caste = DB::table('sub_castes')->where('name', $row['sub_caste'])->first();
        // print_r($me);exit;

        // $stockist = Stockist::where('stockist', $row['stockist']);
        // $stockist->cfa_mail = $row['cfa_mail']

        // if(!$sub_caste) {
            // echo "<pre>";
            // echo "Sub caste <br />"; print_r($sub_caste); echo "<hr/>";
            // // echo "Data <br />"; print_r($row);
            // echo "</pre>";
            // exit;
        // }else{
             // Create a new User record in the `users` table
             $active = 1;
        $user = User::create([
            'name' => $row['first_name'],
            'email' => $row['email'],
            'mobile' => $row['mobile'],
            'password' => Hash::make($row['password']),
            'active' => $active,
        ]);
        

        // If user creation is successful, create the Profile for the user
        if ($user) {
            $memberRole = Role::where('name', 'member')->first();
            $user->assignRole($memberRole);
            // Insert data into `profiles` table
            $caste = 1;

            $dateOfBirth = null;
            if (is_numeric($row['date_of_birth'])) {
                $excelBaseDate = Carbon::createFromDate(1900, 1, 1);
                $dateOfBirth = $excelBaseDate->addDays($row['date_of_birth'] - 2)->format('Y-m-d');
            } elseif (isset($row['date_of_birth'])) {
                $dateOfBirth = Carbon::parse($row['date_of_birth'])->format('Y-m-d');
            }
            
              // Handling Birth Time
            // $birthTime = null;
            // if (is_numeric($row['birth_time'])) {
            //     // Convert the fractional time to hours, minutes, and seconds
            //     $timeInHours = $row['birth_time'] * 24; // convert to hours
            //     $hours = floor($timeInHours); 
            //     $minutes = floor(($timeInHours - $hours) * 60); 
            //     $seconds = floor(($timeInHours - $hours - ($minutes / 60)) * 3600);

            //     $birthTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
            // } elseif (isset($row['birth_time'])) {
            //     // If it's not a fraction, just assume it's in a standard time format
            //     $birthTime = Carbon::parse($row['birth_time'])->format('H:i:s');
            // }
            $birthTime = null;

            if (is_numeric($row['birth_time'])) {
                // Convert the fractional time to hours and minutes
                $timeInHours = $row['birth_time'] * 24; // Convert fraction to hours
                $hours = floor($timeInHours); // Extract integer hours
                $remainingMinutes = ($timeInHours - $hours) * 60; // Convert fractional hours to minutes
                $minutes = floor($remainingMinutes); // Extract integer minutes
            
                // To avoid floating-point errors, calculate seconds from the remaining fraction of minutes
                $remainingSeconds = ($remainingMinutes - $minutes) * 60;
                $seconds = round($remainingSeconds);
            
                // Handle cases where rounding seconds affects the minutes or hours
                if ($seconds == 60) {
                    $seconds = 0;
                    $minutes++;
                    if ($minutes == 60) {
                        $minutes = 0;
                        $hours++;
                    }
                }
            
                // Format the time
                $birthTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
            } elseif (isset($row['birth_time'])) {
                // If the time is already in standard format, just parse and reformat it
                $parsedTime = Carbon::parse($row['birth_time']);
                $birthTime = sprintf('%02d:%02d:%02d', $parsedTime->hour, $parsedTime->minute, 0);
            }
            Log::info('Time value being imported: ' . $birthTime);

            


        //  dd($row['celestial_bodies']. " anoher ". $row['celestial_bodies_2']. " another obe". $row['celestial_bodies_3'] );
            if(!empty($row['celestial_bodies'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies'] = null;
            }

            if(!empty($row['celestial_bodies_2'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies_2'] = null;
            }

            if(!empty($row['celestial_bodies_3'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies_3'] = null;
            }

            if(!empty($row['celestial_bodies_4'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies_4'] = null;
            }

            if(!empty($row['celestial_bodies_5'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies_5'] = null;
            }

            if(!empty($row['celestial_bodies_6'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies_6'] = null;
            }

            if(!empty($row['celestial_bodies_7'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies_7'] = null;
            }

            if(!empty($row['celestial_bodies_8'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies_8'] = null;
            }

            if(!empty($row['celestial_bodies_9'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies_9'] = null;
            }

            if(!empty($row['celestial_bodies_10'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies_10'] = null;
            }

            if(!empty($row['celestial_bodies_11'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies_11'] = null;
            }

            if(!empty($row['celestial_bodies_12'])){
                if (is_string($row['celestial_bodies'])) {
                    $row['celestial_bodies_2'] = explode(',', $row['celestial_bodies_2']);
                }
                $row['celestial_bodies_2'] = implode(',', $row['celestial_bodies_2']);
            }
            else{
                $row['celestial_bodies_12'] = null;
            }
           

            // You may need to map the data from the import row to match your profiles table structure
            $profileData = [
                'user_id' => $user->id, // Link profile to the user
                'first_name' => $row['first_name'],
                'middle_name' => $row['middle_name'],
                'last_name' => $row['last_name'],
                'mother_tongue' => $row['mother_tongue'],
                'email' => $row['email'],
                'native_place' => $row['native_place'],
                'gender' => $row['gender'],
                'marital_status' => $row['marital_status'],
                'living_with' => $row['living_with'],
                'blood_group' => $row['blood_group'],
                'height' => $row['height'],
                'weight' => $row['weight'],
                'body_type' => $row['body_type'],
                'complexion' => $row['complexion'],
                'physical_abnormality' => $row['physical_abnormality'],
                'spectacles' => $row['spectacles'],
                'lens' => $row['lens'],
                'eating_habits' => $row['eating_habits'],
                'role'=>$row['role'],
                'drinking_habits' => $row['drinking_habits'],
                'smoking_habits' => $row['smoking_habits'],
                'about_self' => $row['about_self'],
                'religion' => $row['religion'],
                'caste' => $caste,
                 'gotra' => $row['gotra'],
                'father_is_alive' => $row['father_is_alive'],
                'father_name' => $row['father_name'],
                'father_occupation' => $row['father_occupation'],
                'father_organization' => $row['father_organization'],
                'father_job_type' => $row['father_job_type'],
                'mother_is_alive' => $row['mother_is_alive'],
                'mother_name' => $row['mother_name'],
                'mother_occupation' => $row['mother_occupation'],
                'mother_organization' => $row['mother_organization'],
                'mother_job_type' => $row['mother_job_type'],
                 'mother_native_place' =>$row['mother_native_place'],
                 'mother_name_before_marriage'=> $row['mother_name_before_marriage'],
                'number_of_brothers_married' => $row['number_of_brothers_married'],
                'number_of_brothers_unmarried' => $row['number_of_brothers_unmarried'],
                'brother_resident_place' => $row['brother_resident_place'],
                'number_of_sisters_married' => $row['number_of_sisters_married'],
                'number_of_sisters_unmarried' => $row['number_of_sisters_unmarried'],
                'sister_resident_place' => $row['sister_resident_place'],
                'about_parents' => $row['about_parents'],
                'date_of_birth' => $dateOfBirth,
                'birth_time' => $birthTime,
                'birth_place' => $row['birth_place'],
                'highest_education' => $row['highest_education'],
                'education_in_detail' => $row['education_in_detail'],
                'other_education' => $row['other_education'],
                'additional_degree' => $row['additional_degree'],
                'occupation' => $row['occupation'],
                'organization' => $row['organization'],
                'designation' => $row['designation'],
                'job_location' => $row['job_location'],
                'job_experience' => $row['job_experience'],
                'income' => $row['income'],
                'currency' => $row['currency'],
                'country' => $row['country'],
                'state' => $row['state'],
                'city' => $row['city'],
                'address_line_1' => $row['address_line_1'],
                'address_line_2' => $row['address_line_2'],
                'landmark' => $row['landmark'],
                'pincode' => $row['pincode'],
                'mobile' => $row['mobile'],
                'landline' => $row['landline'],
                'partner_min_age' => $row['partner_min_age'],
                'partner_max_age' => $row['partner_max_age'],
                'partner_min_height' => $row['partner_min_height'],
                'partner_max_height' => $row['partner_max_height'],
                'partner_income' => $row['partner_income'],
                'partner_currency' => $row['partner_currency'],
                'want_to_see_patrika' => $row['want_to_see_patrika'],
                'partner_sub_cast' => $row['partner_sub_cast'],
                'partner_eating_habbit' => $row['partner_eating_habbit'],
                'partner_city_preference' => $row['partner_city_preference'],
                'partner_education' => $row['partner_education'],
                'partner_education_specialization' => $row['partner_education_specialization'],
                'partner_job' => $row['partner_job'],
                'partner_business' => $row['partner_business'],
                'partner_foreign_resident' => $row['partner_foreign_resident'],
                'when_meet' => $row['when_meet'],
                'rashee' => $row['rashee'],
                'nakshatra' => $row['nakshatra'],
                'mangal' => $row['mangal'],
                'charan' => $row['charan'],
                'gana' => $row['gana'],
                'nadi' => $row['nadi'],
                'chart' => $row['chart'],
                'more_about_patrika' => $row['more_about_patrika'],
                'celestial_bodies' => $row['celestial_bodies'],
                'celestial_bodies_2' => $row['celestial_bodies_2'],
                'celestial_bodies_3' => $row['celestial_bodies_3'],
                'celestial_bodies_4' => $row['celestial_bodies_4'],
                'celestial_bodies_5' => $row['celestial_bodies_5'],
                'celestial_bodies_6' => $row['celestial_bodies_6'],
                'celestial_bodies_7' => $row['celestial_bodies_7'],
                'celestial_bodies_8' => $row['celestial_bodies_8'],
                'celestial_bodies_9' => $row['celestial_bodies_9'],
                'celestial_bodies_10' => $row['celestial_bodies_10'],
                'celestial_bodies_11' => $row['celestial_bodies_11'],
                'celestial_bodies_12' => $row['celestial_bodies_12'],
            ];

            // Create Profile for the user
            $profile = Profile::create($profileData);
            //  Auth::login($user);
            // assign package to profile
            $package = Package::find(1);
            if (!$package) {
                return redirect()->back()->with('error', 'package not found');
            }
              
            $latestUserPackage = $user
                ->profile
                ->profilePackages()
                ->withPivot('tokens_received', 'tokens_used', 'starts_at', 'expires_at')
                ->orderBy('expires_at', 'desc')
                ->first();
            if ($latestUserPackage && $latestUserPackage->pivot->expires_at > now()) {
                $startsAt = $latestUserPackage->pivot->expires_at;
            } else {
                $startsAt = now();
            }
            $startsAt = Carbon::parse($startsAt);
    
            $profilePackages = new ProfilePackage();
            $profilePackages->profile_id = $user->profile->id;
            $profilePackages->package_id = $package->id;
            $profilePackages->tokens_received = $package->tokens;
            $profilePackages->tokens_used = 0;
            $profilePackages->starts_at = $startsAt;
            $profilePackages->expires_at = $startsAt->copy()->addDays($package->validity);
            $profilePackages->save();

            //updateTotalTokens
            $totalTokens = ProfilePackage::where('profile_id', $profile->id)
            ->where('expires_at', '>', now())
            ->get()
            ->sum(function($package){
                return $package->tokens_received - $package->tokens_used;
            });
    
             $user->profile->update(['available_tokens'=> $totalTokens]);
             if($user->profile->available_tokens === 0){
                $val = 0;
                    $user->update(['active'=> $val]);
                }else{
                    $val = 1;
                    $user->update(['active'=> $val]);
                }
           
            // package code end
        }

        return null; // Return null as we don’t need to return anything here
        // }
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