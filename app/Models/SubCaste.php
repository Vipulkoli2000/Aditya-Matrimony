<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCaste extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'caste_id',
    ];

    public function caste()
    {
        return $this->belongsTo(Caste::class);
    }
}
