<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Profile;
use App\Traits\CreatedUpdatedBy;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,  LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'mobile'
    ];

      //hasOne relationship
      public function profile()
      {
          return $this->hasOne(Profile::class);
      }
      
      /**
       * Boot method to handle cascading deletes
       */
      protected static function boot()
      {
          parent::boot();
          
          // When a user is deleted, delete their profile and all related records
          static::deleting(function($user) {
              // Delete password reset tokens for this user
              if ($user->email) {
                  \DB::table('password_reset_tokens')->where('email', $user->email)->delete();
              }
              
              if ($user->profile) {
                  // Delete related profile records without triggering User deletion again
                  $profile = $user->profile;
                  
                  // Delete profile packages
                  \DB::table('profile_packages')->where('profile_id', $profile->id)->delete();
                  
                  // Delete profile favorites
                  \DB::table('profile_favorites')->where('profile_id', $profile->id)->delete();
                  \DB::table('profile_favorites')->where('favorite_profile_id', $profile->id)->delete();
                  
                  // Delete profile views
                  \DB::table('profile_views')->where('profile_id', $profile->id)->delete();
                  \DB::table('profile_views')->where('view_profile_id', $profile->id)->delete();
                  
                  // Delete profile interests
                  \DB::table('profile_interests')->where('profile_id', $profile->id)->delete();
                  \DB::table('profile_interests')->where('interest_profile_id', $profile->id)->delete();
                  
                  // Delete profile images
                  if ($profile->img_1 && \Storage::exists('public/images/' . $profile->img_1)) {
                      \Storage::delete('public/images/' . $profile->img_1);
                  }
                  if ($profile->img_2 && \Storage::exists('public/images/' . $profile->img_2)) {
                      \Storage::delete('public/images/' . $profile->img_2);
                  }
                  if ($profile->img_3 && \Storage::exists('public/images/' . $profile->img_3)) {
                      \Storage::delete('public/images/' . $profile->img_3);
                  }
                  if ($profile->img_patrika && \Storage::exists('public/images/' . $profile->img_patrika)) {
                      \Storage::delete('public/images/' . $profile->img_patrika);
                  }
                  
                  // Delete profile record directly to avoid circular deletion
                  \DB::table('profiles')->where('id', $profile->id)->delete();
              }
          });
      }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'email', 'password', 'active']);
        // Chain fluent methods for configuration options
    }
}