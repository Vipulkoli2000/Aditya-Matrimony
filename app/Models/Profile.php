<?php

namespace App\Models;

use App\Models\Caste;
use App\Models\Package;
use App\Models\SubCaste;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        'caste',
        'sub_caste',
        'gotra',
        'father_is_alive',
        'father_name',
        'father_occupation',
        'father_organization',
        'father_mobile',
        'father_address',
        'father_job_type',
        'mother_is_alive',
        'mother_name',
        'mother_occupation',
        'mother_organization',
        'mother_job_type',
        'mother_mobile',
        'mother_address',
        'mother_native_place',
        'mother_name_before_marriage',
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
        'other_education',
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
        'available_tokens',
        'role',
        'when_meet',
        'rashee',
        'nakshatra',
        'mangal',
        'charan',
        'gana',
        'nadi',
        'chart',
        'more_about_patrika',
        'celestial_bodies',
        'celestial_bodies_2',
        'celestial_bodies_3',
        'celestial_bodies_4',
        'celestial_bodies_5',
        'celestial_bodies_6',
        'celestial_bodies_7',
        'celestial_bodies_8',
        'celestial_bodies_9',
        'celestial_bodies_10',
        'celestial_bodies_11',
        'celestial_bodies_12',
        'img_patrika',
        'profile_package_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function profilePackages()
    {
        return $this
            ->belongsToMany(Package::class, 'profile_packages')
            ->withPivot('id', 'tokens_received', 'tokens_used', 'starts_at', 'expires_at')
            ->withTimestamps();
    }

    public function favoriteProfiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_favorites', 'profile_id', 'favorite_profile_id');
    }

    public function viewProfiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_views', 'profile_id', 'view_profile_id');
    }

    public function interestProfiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_interests', 'profile_id', 'interest_profile_id');
    }

    public function subCaste()
    {
        return $this->belongsTo(SubCaste::class, 'sub_caste');
    }
}