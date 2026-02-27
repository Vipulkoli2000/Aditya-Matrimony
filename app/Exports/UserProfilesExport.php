<?php

namespace App\Exports;

use App\Models\Profile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class UserProfilesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;
    
    public function __construct($request = null)
    {
        $this->request = $request;
    }
    
    public function collection()
    {
        $query = Profile::query()
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->select('profiles.*', 'users.email', 'users.mobile as user_mobile', 'users.active')
            ->orderByDesc('users.active')
            ->orderByDesc('profiles.id');

        // If logged in as franchise, filter profiles by franchise_code
        if (Auth::guard('franchise')->check()) {
            $franchise = Auth::guard('franchise')->user();
            $query->where('profiles.franchise_code', $franchise->franchise_code);
        }
    
        if ($this->request && $this->request->has('search') && $this->request->filled('search')) {
            $search = $this->request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereRaw("CONCAT(COALESCE(profiles.first_name, ''), ' ', COALESCE(profiles.middle_name, ''), ' ', COALESCE(profiles.last_name, '')) LIKE ?", ["%{$search}%"])
                    ->orWhere('profiles.first_name', 'like', "%{$search}%")
                    ->orWhere('profiles.middle_name', 'like', "%{$search}%")
                    ->orWhere('profiles.last_name', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('users.mobile', 'like', "%{$search}%");
            });
        }
    
        if ($this->request && $this->request->filled('status')) {
            $status = $this->request->input('status');
            $query->where('users.active', $status);
        }
        
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Mobile',
            'Gender',
            'Email',
            'Franchise Code',
            'Status',
            'Registered Date'
        ];
    }

    public function map($profile): array
    {
        // Build the full name properly
        $nameParts = array_filter([
            trim($profile->first_name),
            trim($profile->middle_name),
            trim($profile->last_name)
        ]);
        
        $fullName = implode(' ', $nameParts);

        return [
            $fullName,
            $profile->mobile,
            $profile->gender,
            $profile->email,
            $profile->franchise_code ?? '-',
            $profile->active ? 'Active' : 'Inactive',
            $profile->created_at ? $profile->created_at->format('d-m-Y') : 'N/A'
        ];
    }
}
