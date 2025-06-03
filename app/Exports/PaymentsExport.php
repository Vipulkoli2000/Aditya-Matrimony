<?php

namespace App\Exports;

use App\Models\ProfilePackage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class PaymentsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
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
        $query = ProfilePackage::with(['profile.user', 'package'])->where('status', true);
        if ($this->request && $this->request->has('from_date') && !empty($this->request->from_date)) {
            $query->whereDate('created_at', '>=', $this->request->from_date);
        }
        if ($this->request && $this->request->has('to_date') && !empty($this->request->to_date)) {
            $query->whereDate('created_at', '<=', $this->request->to_date);
        }
        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Date',
            'Name',
            'Email',
            'Amount',
        ];
    }

    /**
     * @param ProfilePackage $payment
     * @return array
     */
    public function map($payment): array
    {
        return [
            $payment->created_at->format('d-m-Y'),
            $payment->profile ? ucfirst(trim(
                $payment->profile->first_name . ' ' . 
                ($payment->profile->middle_name ?? '') . ' ' . 
                ($payment->profile->last_name ?? '')
            )) : 'N/A',
            $payment->profile->email ?? 'N/A',
            $payment->package->price,
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
                $sheet->mergeCells('A1:D1');
                $sheet->setCellValue('A1', $range);
            },
        ];
    }
}
