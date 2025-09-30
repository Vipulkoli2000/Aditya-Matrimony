<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { font-size: 18px; text-align: center; margin-bottom: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .footer { text-align: center; font-size: 10px; margin-top: 30px; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <div style="flex: 1; text-align: center;">
            <div style="font-size: 24px; font-weight: bold; color: #333; margin-bottom: 4px;">
                Aditya Matrimony
            </div>
            <div style="font-size: 14px; color: #666;">
                A-3, Shalaka Chs, Manpada Road, Bank Of baroda Lane, Dombivli(E)421201
            </div>
        </div>
        <div style="flex: 1; text-align: center;">
        <h1>Payment Report</h1>
                </div>
        <p>Generated on: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
        @if($from_date || $to_date)
            <p>
                @if($from_date)
                    From Date: {{ \Carbon\Carbon::parse($from_date)->format('d-m-Y') }}
                @endif
                @if($to_date)
                    @if($from_date) - @endif
                    To Date: {{ \Carbon\Carbon::parse($to_date)->format('d-m-Y') }}
                @endif
            </p>
        @endif
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $payment->created_at->format('d-m-Y') }}</td>
                    <td>{{ $payment->profile ? ucfirst(trim(
                        $payment->profile->first_name . ' ' . 
                        ($payment->profile->middle_name ?? '') . ' ' . 
                        ($payment->profile->last_name ?? '')
                    )) : 'N/A' }}</td>
                    <td>{{ $payment->profile->email ?? 'N/A' }}</td>
                    <td>{{ $payment->package->price }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No payment records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        <p>{{ config('app.name') }} - Payment Report</p>
    </div>
</body>
</html>
