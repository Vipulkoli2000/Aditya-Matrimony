<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Franchise extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'mobile',
        'location',
        'franchise_code',
        'email',
        'password',
        'active',
    ];

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
        'active' => 'boolean',
    ];

    /**
     * Set the password attribute.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Generate a unique franchise code.
     */
    public static function generateFranchiseCode()
    {
        do {
            $code = 'FR' . strtoupper(substr(uniqid(), -6));
        } while (static::where('franchise_code', $code)->exists());
        
        return $code;
    }

    /**
     * Scope a query to only include active franchises.
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
