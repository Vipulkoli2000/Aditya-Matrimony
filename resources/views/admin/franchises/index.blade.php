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
                                    @if($franchise->active)
                                    <span class="badge badge-outline-success">Active</span>
                                    @else
                                    <span class="badge badge-outline-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2">
                                        <li>
                                            <a href="{{ route('admin.franchises.show', $franchise->id) }}" 
                                               class="btn btn-sm btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <x-edit-button :link="route('admin.franchises.edit', $franchise->id)" />
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.franchises.toggle-status', $franchise->id) }}" 
                                               class="btn btn-sm {{ $franchise->active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                               title="{{ $franchise->active ? 'Deactivate' : 'Activate' }}"
                                               onclick="return confirm('Are you sure you want to {{ $franchise->active ? 'deactivate' : 'activate' }} this franchise?')">
                                                <i class="fas fa-power-off"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <x-delete-button :link="route('admin.franchises.destroy', $franchise->id)" />
                                        </li>
                                    </ul>
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