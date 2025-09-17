<x-layout.admin>
    {{-- <x-add-button :link="route('sub_castes.create')" /> --}}
    <div class="flex justify-between">
        @if((Auth::user() && Auth::user()->hasRole('admin')) || Auth::guard('franchise')->check())
            {{-- <x-excel-button :link="route('sub_castes.import')" /> --}}
            <x-excel-button :link="route('user_profiles.import')" />
            <div class="w-[120px]">
                <a href="{{ route('user_profiles.create') }}" class="btn btn-success px-4 py-2">
                    Add Profile 
                </a>
            </div>
        @endif  
    </div> 
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Profiles</h5>
                <div class="flex items-center">
                    <form action="{{ route('user_profiles.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search profiles" 
                            class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2 mr-2" type="submit">Search</button>
                        <a href="{{ route('user_profiles.export.pdf', request()->query()) }}" target="_blank" class="btn btn-secondary px-4 py-2 mr-2">Download PDF</a>
                        
                        {{-- @if(request('search'))
                            <a href="{{ route('user_profiles.index') }}" class="btn btn-secondary px-4 py-2">Reset</a>
                        @endif --}}

                        <!-- Status Filter & Reset Button -->
                        <div class="flex items-center gap-2">
                            <select name="status" style="border: 1px solid #ccc; border-radius: 4px; padding: 8px; width: 100px;" onchange="resetFilter(this)">
                                <option value="">All</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        
                            @if(request()->has('search') || request()->has('status'))
                                <a href="{{ route('user_profiles.index') }}" class="btn btn-secondary">Reset</a>
                            @endif
                        </div>
                        
                        <script>
                            function resetFilter(select) {
                                if (select.value === "") {
                                    window.location.href = "{{ route('user_profiles.index') }}"; // Redirect to remove filters
                                } else {
                                    select.form.submit(); // Submit the form for other values
                                }
                            }
                        </script>
                        
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Franchise Code</th>
                                <th>Status</th>
                                <th>PDFs</th>
                                <th>Invoice</th>
                                <th>Registered Date</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profiles as $profile)
                            <tr title="{{ $profile->created_at}}">
                                {{-- <td>{{ $profile->id }}</td> --}}
                                <td>{{ $profile->first_name . " " . $profile->middle_name . " " . $profile->last_name }}</td>
                                <td>{{ $profile->mobile }}</td>
                                <td>{{ $profile->gender }}</td>
                                <td>{{ $profile->email }}</td>
                                <td>{{ $profile->franchise_code ?? '-' }}</td>
                                <td>
                                    @if(optional($profile->user)->active)
                                        <span class="text-green-600 font-bold text-xs">Active</span>
                                    @else
                                        <span class="text-red-600 font-bold text-xs">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user_profiles.download', $profile->id) }}"
                                       class="btn btn-secondary btn-sm inline-flex items-center mr-2">
                                        <img src="{{ asset('assets/images/pdf.svg') }}" alt="Profile PDF"
                                             style="width:20px; height:20px; margin-right:5px;">
                                         
                                    </a>
                                  
                                </td>
                                <td>
                                <a href="{{ route('user_profiles.download_invoice', $profile->id) }}"
                                       class="btn btn-info btn-sm inline-flex items-center">
                                        <img src="{{ asset('assets/images/pdf.svg') }}" alt="Invoice PDF"
                                             style="width:20px; height:20px; margin-right:5px;">
                                       
                                    </a>
                                </td>
                                <td>{{ $profile->created_at->format('d-m-Y') }}</td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2">
                                        <li style="display: inline-block; vertical-align: top;">
                                            <x-edit-button :link=" route('user_profiles.edit', $profile->id)" />                               
                                        </li>
                                        @role(['admin'])
                                        <li style="display: inline-block; vertical-align: top;">
                                            <x-delete-button :link=" route('user_profiles.destroy', $profile->id)" />  
                                        </li>
                                        @endrole   
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $profiles->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                // highlightjs
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
