<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caste extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function subCastes()
    {
        return $this->hasMany(SubCaste::class);
    }
}
