<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePackage extends Model
{
    use HasFactory;


    public function profile()
{
    return $this->belongsTo(Profile::class);
}

public function package()
{
    return $this->belongsTo(Package::class);
}

    // protected $table = 'profile_packages';
    // protected $primaryKey = 'id';

    protected $fillable = [
        'profile_id',
        'package_id',
        'tokens_received',
        'tokens_used',
        'starts_at',
        'expires_at',
    ];
    
}