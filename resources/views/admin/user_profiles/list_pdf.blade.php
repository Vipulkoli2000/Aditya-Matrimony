<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profiles Export</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        h2 { margin: 0 0 10px; font-size: 18px; }
        .meta { font-size: 11px; color: #666; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; }
        th { background: #f5f5f5; text-align: left; }
        .text-right { text-align: right; }
        .status-active { color: #138a36; font-weight: bold; }
        .status-inactive { color: #c62828; font-weight: bold; }
        .footer { margin-top: 16px; font-size: 10px; color: #777; text-align: right; }
    </style>
</head>
<body>
    <h2>Profiles Export</h2>
    <div class="meta">
        Generated: {{ $generatedAt->format('d-m-Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Franchise Code</th>
                <th>Status</th>
                <th>Registered Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($profiles as $p)
                <tr>
                    <td>{{ trim(($p->first_name ?? '') . ' ' . ($p->middle_name ?? '') . ' ' . ($p->last_name ?? '')) }}</td>
                    <td>{{ $p->mobile }}</td>
                    <td>{{ $p->gender }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->franchise_code ?? '-' }}</td>
                    <td>
                        @if($p->active)
                            <span class="status-active">Active</span>
                        @else
                            <span class="status-inactive">Inactive</span>
                        @endif
                    </td>
                    <td>{{ optional($p->created_at)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-right">No records found for current filters.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">© {{ date('Y') }} {{ config('app.name') }} — All rights reserved.</div>
</body>
</html>
