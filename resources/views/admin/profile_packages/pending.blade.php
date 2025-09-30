<x-layout.admin>
    <div class="flex justify-between">
        @role(['admin'])
            {{-- Keep space for future actions like export/import if needed --}}
        @endrole   
    </div> 
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Pending Transactions</h5>
                <div class="flex items-center">
                    <form action="{{ route('profile_packages.pending') }}" method="GET" class="flex items-center">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Name/Email/Mobile/Package"
                            class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2 mr-2" type="submit">Search</button>

                        <a href="{{ route('profile_packages.index') }}" class="btn btn-secondary px-4 py-2 mr-2">Back to Profile Packages</a>

                        @if(request('search'))
                            <a href="{{ route('profile_packages.pending') }}" class="btn btn-secondary px-4 py-2">Reset</a>
                        @endif
                    </form>
                </div>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3 text-sm text-amber-600">
                Showing {{ $pendingPackages->count() }} pending transactions (status is null)
            </div>
            
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Package Name</th>
                                <th>Order ID</th>
                                <th>Payment Ref ID</th>
                                <th>Tokens</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingPackages as $index => $packageTransaction)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ optional($packageTransaction->profile->user)->name }}</td>
                                <td>{{ optional($packageTransaction->profile->user)->email }}</td>
                                <td>{{ optional($packageTransaction->profile)->mobile }}</td>
                                <td>{{ optional($packageTransaction->package)->name }}</td>
                                <td>{{ $packageTransaction->order_id ?? 'N/A' }}</td>
                                <td>{{ $packageTransaction->payment_ref_id ?? 'N/A' }}</td>
                                <td>{{ $packageTransaction->tokens_received }}</td>
                                <td>{{ $packageTransaction->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                </td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2">
                                        <li style="display: inline-block; vertical-align: top;">
                                            <a href="{{ route('profile_packages.edit_status', $packageTransaction->id) }}" 
                                               class="btn btn-success btn-sm">Change Status</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="text-center py-4">No pending transactions found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .badge {
            padding: 0.25em 0.5em;
            border-radius: 0.25rem;
            font-size: 0.875em;
            font-weight: 600;
        }
        .bg-warning {
            background-color: #ffc107;
        }
        .text-dark {
            color: #212529;
        }
        .alert {
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>
    
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                codeArr: [],
                toggleCode(name) {
                    if (this.codeArr.includes(name)) {
                        this.codeArr = this.codeArr.filter((d) => d != name);
                    } else {
                        this.codeArr.push(name);
                        setTimeout(() => {
                            document.querySelectorAll('pre.code').forEach(el => {
                                hljs.highlightElement(el);
                            });
                        });
                    }
                }
            }));
        });
    </script>
</x-layout.admin>
