<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Registrations Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { font-size: 18px; text-align: center; margin-bottom: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .footer { text-align: center; font-size: 10px; margin-top: 30px; }
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
        <h1>User Registrations Report</h1>
                </div>
        <p>Generated on: {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</p>
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
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Registration Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($registrations as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ ucfirst($user->name) }}</td>
                    <td>{{ ucfirst($user->email) }}</td>
                    <td>{{ $user->profile->mobile ?? 'N/A' }}</td>
                    <td>{{ ucfirst($user->profile->gender ?? 'N/A') }}</td>
                    <td>{{ $user->profile->date_of_birth ?? 'N/A' }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No registrations found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        <p>{{ config('app.name') }} - User Registrations Report</p>
    </div>
</body>
</html>
