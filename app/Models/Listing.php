<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'listing_category_id',
        'business_name',
        'description',
        'contact_person',
        'address',
        'email',
        'mobile',
        'country',
        'state',
        'city',
        'photo',
        'is_active'
    ];
    
    public function category()
    {
        return $this->belongsTo(ListingCategory::class, 'listing_category_id');
    }
}
