<x-layout.admin>
    <div class="panel">
        <div class="mb-5 flex flex-wrap justify-between">
            <div class="mb-4 w-full lg:w-1/2">
                <h3 class="text-xl font-bold">Expiring Packages Report</h3>
                <p class="text-gray-600">View and export data for packages expiring in the next 30 days</p>
            </div>
            <div class="flex w-full flex-wrap items-center justify-end gap-3 lg:w-1/2">
                <a href="{{ route('admin.reports.expiring-packages.export.pdf', request()->query()) }}" class="btn btn-danger">
                    <i class="fa fa-file-pdf-o mr-2"></i>Export as PDF
                </a>
                <a href="{{ route('admin.reports.expiring-packages.export.excel', request()->query()) }}" class="btn btn-success ml-2">
                    <i class="fa fa-file-excel-o mr-2"></i>Export as Excel
                </a>
            </div>
        </div>

        <!-- Date Range Filter -->
        <div class="panel mb-5">
            <form action="{{ route('admin.reports.expiring-packages') }}" method="GET" class="flex flex-wrap items-end gap-4">
                <div class="form-group">
                    <label for="from_date" class="mb-2 block text-sm font-medium">From Date</label>
                    <input type="date" id="from_date" name="from_date" class="form-input" value="{{ request('from_date') }}">
                </div>
                <div class="form-group">
                    <label for="to_date" class="mb-2 block text-sm font-medium">To Date</label>
                    <input type="date" id="to_date" name="to_date" class="form-input" value="{{ request('to_date') }}">
                </div>
                <div class="form-group flex space-x-2 mt-6">
                    <button type="submit" class="btn btn-primary px-3" style="height:43px">Filter</button>
                    <a href="{{ route('admin.reports.expiring-packages') }}" class="btn btn-outline-danger px-3" style="height:43px">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table-striped table-hover table">
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
                                    $bgColor = $daysRemaining > 0
                                        ? ($daysRemaining <= 7 ? '#dc3545' : '#ffc107')
                                        : '#dc3545';
                                    $textColor = $daysRemaining > 0
                                        ? ($daysRemaining <= 7 ? '#fff' : '#000')
                                        : '#fff';
                                    $label = $daysRemaining > 0 ? $daysRemaining . ' days' : 'Expired';
                                @endphp
                                <span style="background-color: {{ $bgColor }}; color: {{ $textColor }}; padding: 4px 8px; border-radius: 4px; display: inline-block;">
                                    {{ $label }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No expiring packages found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $expiringPackages->links() }}
        </div>
    </div>
</x-layout.admin>
