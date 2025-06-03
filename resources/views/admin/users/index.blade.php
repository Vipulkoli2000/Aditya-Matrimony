<x-layout.admin>
    <div class="w-[15%] mt-2">
        <a class="btn btn-primary" href="{{ route('refresh_status.refresh') }}">Refresh Status</a>
    </div>
    <br><br>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Users</h5>
                <!-- Search & Filter Form -->
                <form method="GET" action="{{ route('users.index') }}" class="flex flex-col gap-2">
                    <!-- Search Input and Button -->
                    <div class="flex items-center gap-2">
                        <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}"
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
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Reset</a>
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
                                <th>Role</th>
                                 <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    @foreach($user->roles as $role)                   
                                    <span class="badge whitespace-nowrap badge bg-info">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                 <td>
                                    @if($user->active == '1')
                                    <span class="badge badge-outline-success">Active</span>
                                    @else
                                    <span class="badge badge-outline-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2">
                                        <li>
                                            <x-edit-button :link=" route('users.edit', $user->id)" />
                                        </li>
                                        <li>
                                            <x-delete-button :link=" route('users.destroy', $user->id)" />
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->appends(['search' => request('search'), 'status' => request('status')])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
