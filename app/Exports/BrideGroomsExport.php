<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BrideGroomsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = User::with('profile')->role('member');

        if ($this->request && $this->request->has('from_date') && !empty($this->request->from_date)) {
            $query->whereDate('created_at', '>=', $this->request->from_date);
        }
        if ($this->request && $this->request->has('to_date') && !empty($this->request->to_date)) {
            $query->whereDate('created_at', '<=', $this->request->to_date);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Role',
            'Date of Birth'
        ];
    }

    public function map($user): array
    {
        $role = ucfirst(optional($user->profile)->role ?? 'N/A');
        return [
            $user->name,
            $user->email,
            optional($user->profile)->mobile ?? 'N/A',
            $role,
            optional($user->profile)->date_of_birth ?? 'N/A'
        ];
    }
}
