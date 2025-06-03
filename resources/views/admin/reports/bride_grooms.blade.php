<x-layout.admin>
    <div class="panel">
        <div class="mb-5 flex flex-wrap justify-between">
            <div class="mb-4 w-full lg:w-1/2">
                <h3 class="text-xl font-bold">Bride/Grooms Report</h3>
                <p class="text-gray-600">View and export Bride/Grooms data</p>
            </div>
            <div class="flex w-full flex-wrap items-center justify-end gap-3 lg:w-1/2">
                <div class="flex space-x-2">
                    <a href="{{ route('admin.reports.bride-grooms.export.pdf', request()->query()) }}" class="btn btn-danger">
                        PDF
                    </a>
                    <a href="{{ route('admin.reports.bride-grooms.export.excel', request()->query()) }}" class="btn btn-success">
                        Excel
                    </a>
                </div>
            </div>
        </div>

        <div class="panel mb-5">
            <form action="{{ route('admin.reports.bride-grooms') }}" method="GET" class="flex flex-wrap items-end gap-4">
                <div class="form-group">
                    <label for="from_date" class="mb-2 block text-sm font-medium">From Date</label>
                    <input type="date" id="from_date" name="from_date" class="form-input" value="{{ request('from_date') }}">
                </div>
                <div class="form-group">
                    <label for="to_date" class="mb-2 block text-sm font-medium">To Date</label>
                    <input type="date" id="to_date" name="to_date" class="form-input" value="{{ request('to_date') }}">
                </div>
                <div class="form-group">
                    <label for="role" class="mb-2 block text-sm font-medium">Role</label>
                    <select id="role" name="role" class="form-input">
                        <option value="">All</option>
                        <option value="bride" {{ request('role') == 'bride' ? 'selected' : '' }}>Bride</option>
                        <option value="groom" {{ request('role') == 'groom' ? 'selected' : '' }}>Groom</option>
                    </select>
                </div>
                <div class="form-group flex space-x-2 mt-6">
                    <button type="submit" class="btn btn-primary px-3" style="height:43px">Filter</button>
                    <a href="{{ route('admin.reports.bride-grooms') }}" class="btn btn-outline-danger px-3" style="height:43px">Reset</a>
                </div>
            </form>
        </div>

        <div class="mb-4 text-lg font-semibold">
            @if(request('role') === 'bride')
                Total Brides: {{ $brideGrooms->total() }}
            @elseif(request('role') === 'groom')
                Total Grooms: {{ $brideGrooms->total() }}
            @else
                Total Users: {{ $brideGrooms->total() }}
            @endif
        </div>

        <div class="table-responsive">
            <table class="table-striped table-hover table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Date of Birth</th>
                        <th>Registered On</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brideGrooms as $user)
                        <tr>
                            <td>{{ ucfirst($user->name) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->profile->mobile ?? 'N/A' }}</td>
                            <td>{{ ucfirst($user->profile->role ?? 'N/A') }}</td>
                            <td>{{ optional($user->profile)->date_of_birth ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d-m-Y') : 'N/A' }}</td>
                            <td>{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $brideGrooms->links() }}
        </div>
    </div>
</x-layout.admin>
