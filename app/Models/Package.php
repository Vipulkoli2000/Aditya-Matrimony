<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    // protected $table = "packages";
    // protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'tokens',
        'validity',
        'description',
        'price',
    ];

    public function profile(){
        return $this->belongsToMany(Profile::class, 'profile_packages')
        ->withPivot('tokens_received', 'tokens_used', 'starts_at', 'expires_at');
    }
    
}