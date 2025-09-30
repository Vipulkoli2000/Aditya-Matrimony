<x-layout.admin>
    {{-- Match UI with admin/user_profiles --}}
    <div class="flex justify-between">
        @role(['admin'])
            {{-- Keep space for future actions like export/import if needed --}}
        @endrole   
    </div> 
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Profile Packages</h5>
                <div class="flex items-center">
                    <form action="{{ route('profile_packages.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Email/Mobile"
                            class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2 mr-2" type="submit">Search</button>

                        <a href="{{ route('profile_packages.pending') }}" class="btn btn-warning px-4 py-2 mr-2">Pending Transactions</a>

                        @if(request('search'))
                            <a href="{{ route('profile_packages.index') }}" class="btn btn-secondary px-4 py-2">Reset</a>
                        @endif
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Available Tokens</th>
                                <th>Packages</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ optional($user->profile)->mobile }}</td>
                                <td>{{ optional($user->profile)->gender }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="text-blue-600 font-bold text-xs">{{ optional($user->profile)->available_tokens ?? 0 }}</span>
                                </td>
                                <td>
                                    @if($user->profile)
                                        {{ $user->profile->profilePackages->count() }}
                                    @else
                                        0
                                    @endif
                                </td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2">
                                        <li style="display: inline-block; vertical-align: top;">
                                            <a href="{{ route('profile_packages.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
