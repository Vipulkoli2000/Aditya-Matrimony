<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Expiring Packages Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { font-size: 18px; text-align: center; margin-bottom: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .footer { text-align: center; font-size: 10px; margin-top: 30px; }
        .warning { color: orange; font-weight: bold; }
        .danger { color: red; font-weight: bold; }
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
        <!-- <div style='display: flex; align-items: center; margin-bottom: 20px;'>
            <img src="{{ public_path('assets/user/img/logo.png') }}" style='height: 40px; margin-right: 15px;'>
           
        </div> -->
        <div style="flex: 1; text-align: center;">
                <h1>{{ __('Expiring Packages Report') }}</h1>
            </div>
        <p>Generated on: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
        @if(isset($from_date) || isset($to_date))
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
                <th>ID</th>
                <th>User</th>
                <th>Package</th>
                <th>Start Date</th>
                <th>Expiry Date</th>
                <th>Days Remaining</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($expiringPackages as $package)
                <tr>
                    <td>{{ $package->id }}</td>
                    <td>{{ optional($package->profile->user)->name ? ucfirst(optional($package->profile->user)->name) : 'N/A' }}</td>
                    <td>{{ $package->package->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($package->starts_at)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($package->expires_at)->format('d-m-Y') }}</td>
                    <td>
                        @php
                            $daysRemaining = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($package->expires_at), false);
                        @endphp
                        @if($daysRemaining > 0)
                            @if($daysRemaining <= 7)
                                <span class="danger">{{ $daysRemaining }} days</span>
                            @else
                                <span class="warning">{{ $daysRemaining }} days</span>
                            @endif
                        @else
                            <span class="danger">Expired</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">No expiring packages found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        <p>{{ config('app.name') }} - Expiring Packages Report</p>
    </div>
</body>
</html>
