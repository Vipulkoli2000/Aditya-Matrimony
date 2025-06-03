<x-layout.admin>
    <div class="panel">
        <div class="mb-5 flex flex-wrap justify-between">
            <div class="mb-4 w-full lg:w-1/2">
                <h3 class="text-xl font-bold">Payment Reports</h3>
                <p class="text-gray-600">View and export payment transaction data</p>
            </div>
            <div class="flex w-full flex-wrap items-center justify-end gap-3 lg:w-1/2">
                <a href="{{ route('admin.reports.payments.export.pdf', request()->query()) }}" class="btn btn-danger">
                    <i class="fa fa-file-pdf-o mr-2"></i>Export as PDF
                </a>
                <a href="{{ route('admin.reports.payments.export.excel', request()->query()) }}" class="btn btn-success ml-2">
                    <i class="fa fa-file-excel-o mr-2"></i>Export as Excel
                </a>
            </div>
        </div>

        <!-- Date Range Filter -->
        <div class="panel mb-5">
            <form action="{{ route('admin.reports.payments') }}" method="GET" class="flex flex-wrap items-end gap-4">
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
                    <a href="{{ route('admin.reports.payments') }}" class="btn btn-outline-danger px-3" style="height:43px">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table-striped table-hover table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Amount (&#8377;)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                    <tr>
                        <td>{{ optional($payment->created_at)->format('d-m-Y') ?? 'N/A' }}</td>
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
                            <td colspan="4" class="text-center">No payment records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $payments->links() }}
        </div>
    </div>
</x-layout.admin>
