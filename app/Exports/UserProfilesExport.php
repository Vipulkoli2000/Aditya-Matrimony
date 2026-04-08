<?php

namespace App\Exports;

use App\Models\Profile;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class UserProfilesExport implements FromQuery, WithHeadings, WithMapping, WithDrawings, WithStyles, WithColumnWidths, WithColumnFormatting
{
    protected $request;
    protected $tableColumns;
    protected $processedProfiles;

    public function __construct($request = null)
    {
        $this->request = $request;
        
        $allColumns = Schema::getColumnListing('profiles');
        $exclude = ['id', 'user_id', 'profile_package_id', 'img_1', 'img_2', 'img_3'];
        
        $this->tableColumns = array_values(array_filter($allColumns, function($col) use ($exclude) {
            return !in_array($col, $exclude);
        }));
    }

    public function query()
    {
        $query = Profile::query()
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->leftJoin('castes', 'profiles.caste', '=', 'castes.id')
            ->leftJoin('sub_castes', 'profiles.sub_caste', '=', 'sub_castes.id')
            ->select(
                'profiles.*', 
                'users.email as login_email', 'users.mobile as login_mobile', 'users.active as login_status',
                'castes.name as caste_name',
                'sub_castes.name as sub_caste_name'
            )
            ->orderByDesc('users.active')
            ->orderByDesc('profiles.id');

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

        return $query;
    }

    public function headings(): array
    {
        $readableHeaders = [
            'Full Name',
            'Login Email',
            'Login Mobile',
            'Account Status (Active/Inactive)',
        ];

        foreach ($this->tableColumns as $col) {
            $readableHeaders[] = ucwords(str_replace('_', ' ', $col));
        }

        $readableHeaders[] = 'Photo 1';
        $readableHeaders[] = 'Photo 2';
        $readableHeaders[] = 'Photo 3';

        return $readableHeaders;
    }

    public function map($profile): array
    {
        $nameParts = array_filter([
            trim($profile->first_name),
            trim($profile->middle_name),
            trim($profile->last_name)
        ]);
        $fullName = implode(' ', $nameParts);

        $data = [
            $fullName,
            $profile->login_email,
            (string)$profile->login_mobile, // Force string in PHP
            $profile->login_status ? 'Active' : 'Inactive',
        ];

        foreach ($this->tableColumns as $col) {
            if ($col == 'caste') {
                $data[] = $profile->caste_name ?? $profile->caste;
            } elseif ($col == 'sub_caste') {
                $data[] = $profile->sub_caste_name ?? $profile->sub_caste;
            } elseif ($col == 'mobile' || $col == 'landline') {
                $data[] = (string)$profile->$col;
            } else {
                $data[] = $profile->$col;
            }
        }

        // Add placeholders for photos
        $data[] = ''; $data[] = ''; $data[] = '';

        return $data;
    }

    public function columnFormats(): array
    {
        $formats = [
            'C' => NumberFormat::FORMAT_TEXT, // Login Mobile
        ];

        // Apply text formatting to all mobile/phone columns to prevent scientific notation
        foreach ($this->tableColumns as $index => $col) {
            if (in_array($col, ['mobile', 'landline', 'father_mobile', 'mother_mobile'])) {
                $colLetter = Coordinate::stringFromColumnIndex(4 + $index + 1);
                $formats[$colLetter] = NumberFormat::FORMAT_TEXT;
            }
        }

        return $formats;
    }

    public function drawings()
    {
        $drawings = [];
        $this->processedProfiles = $this->query()->get();
        $photoStartIdx = 4 + count($this->tableColumns) + 1; 

        foreach ($this->processedProfiles as $index => $profile) {
            $row = $index + 2;
            $imgFields = ['img_1', 'img_2', 'img_3'];
            foreach ($imgFields as $idx => $field) {
                if ($profile->$field && Storage::exists('public/images/' . $profile->$field)) {
                    $path = storage_path('app/public/images/' . $profile->$field);
                    if (file_exists($path)) {
                        $drawing = new Drawing();
                        $drawing->setName('Profile Photo');
                        $drawing->setPath($path);
                        $drawing->setHeight(90); 
                        $drawing->setOffsetX(10);
                        $drawing->setOffsetY(5);
                        $colLetter = Coordinate::stringFromColumnIndex($photoStartIdx + $idx);
                        $drawing->setCoordinates($colLetter . $row);
                        $sizes = getimagesize($path);
                        if ($sizes && ($sizes[0] / $sizes[1]) > 2) { $drawing->setWidth(180); }
                        $drawings[] = $drawing;
                    }
                }
            }
        }
        return $drawings;
    }

    public function styles(Worksheet $sheet)
    {
        $totalColsCount = 4 + count($this->tableColumns) + 3;
        $lastCol = Coordinate::stringFromColumnIndex($totalColsCount);
        $photoStartCol = Coordinate::stringFromColumnIndex(4 + count($this->tableColumns) + 1);

        $sheet->getStyle('A:' . $lastCol)->getAlignment()->setVertical('center');
        $sheet->getStyle($photoStartCol . ':' . $lastCol)->getAlignment()->setHorizontal('center');
        
        $count = $this->query()->count();
        for ($i = 0; $i < $count; $i++) {
            $sheet->getRowDimension($i + 2)->setRowHeight(100);
        }

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        $widths = [
            'A' => 35, // Full Name
            'B' => 25, // Login Email
            'C' => 20, // Login Mobile
            'D' => 15, // Status
        ];

        for ($i = 5; $i <= (4 + count($this->tableColumns)); $i++) {
            $widths[Coordinate::stringFromColumnIndex($i)] = 20;
        }

        $photoStartIdx = 4 + count($this->tableColumns) + 1;
        for ($i = 0; $i < 3; $i++) {
            $widths[Coordinate::stringFromColumnIndex($photoStartIdx + $i)] = 30;
        }

        return $widths;
    }
}
