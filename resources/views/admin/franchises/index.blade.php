<x-layout.admin>
    <div class="w-[15%] mt-2">
        <a class="btn btn-primary" href="{{ route('admin.franchises.create') }}">Add Franchise</a>
    </div>
    <br><br>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Franchise Management</h5>
                <!-- Search & Filter Form -->
                <form method="GET" action="{{ route('admin.franchises.index') }}" class="flex flex-col gap-2">
                    <!-- Search Input and Button -->
                    <div class="flex items-center gap-2">
                        <input type="text" name="search" placeholder="Search franchises..." value="{{ request('search') }}"
                            class="border rounded p-2 w-60" />
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                
                    <!-- Status Filter & Reset Button -->
                    <div class="flex items-center gap-2">
                        <select name="status" class="border rounded p-2 w-60" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                
                        @if(request()->has('search') || request()->has('status'))
                            <a href="{{ route('admin.franchises.index') }}" class="btn btn-secondary">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Location</th>
                                <th>Franchise Code</th>
                                <th>Amount Paid</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($franchises as $franchise)
                            <tr>
                                <td>{{ $franchise->name }}</td>
                                <td>{{ $franchise->email }}</td>
                                <td>{{ $franchise->mobile }}</td>
                                <td>{{ $franchise->location }}</td>
                                <td>
                                    <span class="badge badge-outline-primary">{{ $franchise->franchise_code }}</span>
                                </td>
                                <td>
                                    @php
                                        $currentYear = date('Y');
                                        $payment = $franchise->paymentForYear($currentYear);
                                        $paidMonths = $payment ? $payment->paid_months_count : 0;
                                    @endphp
                                    <a href="{{ route('admin.franchises.payments', $franchise->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-money-check-alt mr-1"></i>
                                        {{ $paidMonths }}/12 Months
                                    </a>
                                </td>
                                <td>
                                    @if($franchise->active)
                                    <span class="badge badge-outline-success">Active</span>
                                    @else
                                    <span class="badge badge-outline-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('admin.franchises.show', $franchise->id) }}" 
                                           class="btn btn-sm btn-outline-info" title="View">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.5" d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z" stroke="currentColor" stroke-width="1.5"/>
                                                <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"/>
                                            </svg>
                                        </a>
                                        <x-edit-button :link="route('admin.franchises.edit', $franchise->id)" />
                                        <a href="{{ route('admin.franchises.toggle-status', $franchise->id) }}" 
                                           class="btn btn-sm {{ $franchise->active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                           title="{{ $franchise->active ? 'Deactivate' : 'Activate' }}"
                                           onclick="return confirm('Are you sure you want to change the status of this franchise?')">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.5 9.50026V14.5003M12 6.00026V18.0003M17.5 9.50026V14.5003M6 3.00026H18C20.2091 3.00026 22 4.79112 22 7.00026V17.0003C22 19.2094 20.2091 21.0003 18 21.0003H6C3.79086 21.0003 2 19.2094 2 17.0003V7.00026C2 4.79112 3.79086 3.00026 6 3.00026Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <x-delete-button :link="route('admin.franchises.destroy', $franchise->id)" />
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">No franchises found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $franchises->appends(['search' => request('search'), 'status' => request('status')])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>