<x-layout.admin>
    <div class="panel">
        <div class="mb-5 flex flex-wrap justify-between">
            <div class="mb-4 w-full lg:w-1/2">
                <h3 class="text-xl font-bold">User Registrations Report</h3>
                <p class="text-gray-600">View and export user registration data</p>
            </div>
            <div class="flex w-full flex-wrap items-center justify-end gap-3 lg:w-1/2">
                <div class="flex space-x-2">
                    <a href="{{ route('admin.reports.registrations.export.pdf', request()->query()) }}" class="btn btn-danger">
                        PDF
                    </a>
                    <a href="{{ route('admin.reports.registrations.export.excel', request()->query()) }}" class="btn btn-success">
                        Excel
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Date Range Filter -->
        <div class="panel mb-5">
            <form action="{{ route('admin.reports.registrations') }}" method="GET" class="flex flex-wrap items-end gap-4">
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
                    <a href="{{ route('admin.reports.registrations') }}" class="btn btn-outline-danger px-3" style="height:43px">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table-striped table-hover table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        
                        <!-- <th>Package</th> -->
                        <!-- <th>Tokens</th> -->
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
                             
                            <!-- <td>
                                @php
                                    $currentPackage = 'None';
                                    if ($user->profile && $user->profile->profilePackages && $user->profile->profilePackages->count() > 0) {
                                        $latestPackage = $user->profile->profilePackages->sortByDesc(function($package) {
                                            return $package->pivot->expires_at;
                                        })->first();
                                        
                                        if ($latestPackage) {
                                            $currentPackage = $latestPackage->name;
                                        }
                                    }
                                    echo $currentPackage;
                                @endphp
                            </td> -->
                            <!-- <td>{{ $user->profile->available_tokens ?? 0 }}</td> -->
                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No registrations found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $registrations->links() }}
        </div>
    </div>
</x-layout.admin>
