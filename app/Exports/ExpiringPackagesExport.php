<?php

namespace App\Exports;

use App\Models\ProfilePackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExpiringPackagesExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    private $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Default window: now to next 30 days
        $expiringDate = Carbon::now()->addDays(30);
        $query = ProfilePackage::with(['profile', 'package'])
            ->whereDate('expires_at', '>=', Carbon::now())
            ->whereDate('expires_at', '<=', $expiringDate);

        // Apply user filters
        if ($this->request && $this->request->has('from_date') && !empty($this->request->from_date)) {
            $query->whereDate('expires_at', '>=', $this->request->from_date);
        }
        if ($this->request && $this->request->has('to_date') && !empty($this->request->to_date)) {
            $query->whereDate('expires_at', '<=', $this->request->to_date);
        }

        return $query->orderBy('expires_at', 'asc')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Package',
            'Start Date',
            'Expiry Date',
            'Days Remaining'
        ];
    }

    /**
     * @param ProfilePackage $package
     * @return array
     */
    public function map($package): array
    {
        $daysRemaining = Carbon::now()->diffInDays(Carbon::parse($package->expires_at), false);
        
        return [
            $package->id,
            ucfirst(optional($package->profile->user)->name ?? 'N/A'),
            $package->package->name ?? 'N/A',
            Carbon::parse($package->starts_at)->format('d-m-Y'),
            Carbon::parse($package->expires_at)->format('d-m-Y'),
            $daysRemaining > 0 ? $daysRemaining : 'Expired'
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
                $sheet->mergeCells('A1:F1');
                $sheet->setCellValue('A1', $range);
            },
        ];
    }
}
