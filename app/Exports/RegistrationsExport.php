<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class RegistrationsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $request;
    
    /**
     * Constructor to pass request data for filtering
     */
    public function __construct($request = null)
    {
        $this->request = $request;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = User::with(['profile', 'profile.profilePackages'])
            ->role('member');  // Using Spatie's role() scope instead of where('role', 'member')
            
        // Apply date filters if provided
        if ($this->request && $this->request->has('from_date') && !empty($this->request->from_date)) {
            $query->whereDate('created_at', '>=', $this->request->from_date);
        }
        
        if ($this->request && $this->request->has('to_date') && !empty($this->request->to_date)) {
            $query->whereDate('created_at', '<=', $this->request->to_date);
        }
        
        return $query->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Gender',
            'Date of Birth',
            'Registration Date'
        ];
    }

    /**
     * @param User $user
     * @return array
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->profile->mobile ?? 'N/A',
            $user->profile->gender ?? 'N/A',
            $user->profile->date_of_birth ?? 'N/A',
            $user->created_at->format('d-m-Y')
        ];
    }

    public function registerEvents(): array
    {
        $from = $this->request->from_date ?? null;
        $to = $this->request->to_date ?? null;
        $fromFormatted = $from ? Carbon::parse($from)->format('d-m-Y') : 'N/A';
        $toFormatted = $to ? Carbon::parse($to)->format('d-m-Y') : 'N/A';
        $range = 'Date Range: ' . $fromFormatted . ' to ' . $toFormatted;
        return [
            AfterSheet::class => function(AfterSheet $event) use ($range) {
                $sheet = $event->sheet->getDelegate();
                $sheet->insertNewRowBefore(1, 1);
                $sheet->mergeCells('A1:G1');
                $sheet->setCellValue('A1', $range);
            },
        ];
    }
}
