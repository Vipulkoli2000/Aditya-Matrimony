<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchisePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'franchise_id',
        'year',
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
    ];

    protected $casts = [
        'january' => 'boolean',
        'february' => 'boolean',
        'march' => 'boolean',
        'april' => 'boolean',
        'may' => 'boolean',
        'june' => 'boolean',
        'july' => 'boolean',
        'august' => 'boolean',
        'september' => 'boolean',
        'october' => 'boolean',
        'november' => 'boolean',
        'december' => 'boolean',
    ];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

    public function getPaidMonthsCountAttribute()
    {
        $count = 0;
        $months = ['january', 'february', 'march', 'april', 'may', 'june', 
                   'july', 'august', 'september', 'october', 'november', 'december'];
        
        foreach ($months as $month) {
            if ($this->$month) {
                $count++;
            }
        }
        
        return $count;
    }
}
