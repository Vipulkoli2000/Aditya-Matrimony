<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Invoice</title>
</head>

@php
    // your actual logo path
    $logoPath = public_path('assets/user/img/logo.png');

    if (! file_exists($logoPath)) {
        throw new \Exception("Logo file not found at {$logoPath}");
    }

    $logoData = base64_encode(file_get_contents($logoPath));
    $logoMime = mime_content_type($logoPath);
@endphp

<body style="font-family: Arial, sans-serif; padding: 10px 20px;">

    <!-- header row: logo on left, title + sub-header centered -->
    <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <!-- logo -->
        <div style="width: 100px; margin-right: 15px;">
            <img
                src="data:{{ $logoMime }};base64,{{ $logoData }}"
                alt="Logo"
                style="max-width: 111%; height: auto;"
            >
        </div>

        <!-- header text block, centered across remaining space -->
        <div style="flex: 1; text-align: center;">
            <div style="font-size: 24px; font-weight: bold; color: #333; margin-bottom: 4px;">
                Aditya Matrimony
            </div>
             
            <div style="font-size: 14px; color: #666;">
                Aditya Matrimony,
Dombivli (West), Maharashtra 421202        
        </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <!-- invoice‑details: Invoice No left, Date right -->
    <div style="margin-bottom: 20px; overflow: auto;">
        <span style="float: left; margin: 0;">
            <strong>Invoice No:</strong> {{ $invoiceNumber }}
        </span>
        <span style="float: right; margin: 0;">
            <strong>Date:</strong> {{ $invoiceDate->format('d-m-Y') }}
        </span>
    </div>

    <!-- customer info -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin: 30px 0 20px;">
        <div>
            <p style="margin: 0;"><strong>Customer Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
            @if(!empty($user->address_line_1))
                <p style="margin: 0;">
                    <strong>Address:</strong>
                    {{ $user->address_line_1 }}
                    @if(!empty($user->address_line_2)), {{ $user->address_line_2 }}@endif,
                    {{ $user->city }}, {{ $user->state }} - {{ $user->pincode }}
                </p>
            @endif
        </div>
    </div>

    <!-- items table -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 12px; text-align: left; background-color: #f5f5f5;">Package Name</th>
                <th style="border: 1px solid #ddd; padding: 12px; text-align: left; background-color: #f5f5f5;">Description</th>
                 <th style="border: 1px solid #ddd; padding: 12px; text-align: left; background-color: #f5f5f5;">Purchase Date</th>
                <th style="border: 1px solid #ddd; padding: 12px; text-align: left; background-color: #f5f5f5;">To Date</th>
                <th style="border: 1px solid #ddd; padding: 12px; text-align: left; background-color: #f5f5f5;">Amount (Rs.)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grossAmount = $package->price;
                $taxRate = 0.18;
                $netAmount = $grossAmount / (1 + $taxRate);
            @endphp
            <tr>
                <td style="border: 1px solid #ddd; padding: 12px;">{{ $package->name }}</td>
                <td style="border: 1px solid #ddd; padding: 12px;">{{ $package->description }}</td>
                 <td style="border: 1px solid #ddd; padding: 12px;">{{ optional($package->pivot)->created_at ? $package->pivot->created_at->format('d-m-Y') : $package->created_at->format('d-m-Y') }}</td>
                <td style="border: 1px solid #ddd; padding: 12px;">{{ (optional($package->pivot)->created_at ?? $package->created_at)->copy()->addDays($package->validity)->format('d-m-Y') }}</td>
                <td style="border: 1px solid #ddd; padding: 12px;">Rs. {{ number_format($netAmount, 2) }}</td>
            </tr>
        </tbody>
        @php
            // Reverse tax calculation for gross-inclusive price
            $userState = strtolower($user->state ?? '');
            $isLocal = $userState === 'maharashtra';
            $cgst = $isLocal ? $netAmount * 0.09 : 0;
            $sgst = $isLocal ? $netAmount * 0.09 : 0;
            $igst = $isLocal ? 0 : $netAmount * $taxRate;
            $totalAmount = $grossAmount;
        @endphp
        <tfoot>
            @if($isLocal)
                <tr>
                    <td colspan="4" style="border: 1px solid #ddd; padding: 12px; text-align: right;">CGST (9%):</td>
                    <td style="border: 1px solid #ddd; padding: 12px;">Rs. {{ number_format($cgst, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="border: 1px solid #ddd; padding: 12px; text-align: right;">SGST (9%):</td>
                    <td style="border: 1px solid #ddd; padding: 12px;">Rs. {{ number_format($sgst, 2) }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="4" style="border: 1px solid #ddd; padding: 12px; text-align: right;">IGST (18%):</td>
                    <td style="border: 1px solid #ddd; padding: 12px;">Rs. {{ number_format($igst, 2) }}</td>
                </tr>
            @endif
            <tr>
                <td colspan="4" style="border: 1px solid #ddd; padding: 12px; text-align: right; font-weight: bold;">Total Amount:</td>
                <td style="border: 1px solid #ddd; padding: 12px; font-weight: bold;">Rs. {{ number_format($totalAmount, 2) }}</td>
            </tr>
        </tfoot>
    </table>


</body>
</html>
