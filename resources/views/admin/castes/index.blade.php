<x-layout.admin>
    <x-add-button :link="route('castes.create')" />
    @role(['admin'])
        {{-- <x-excel-button :link="route('castes.import')" /> --}}
    @endrole    
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Castes</h5>
                <div class="flex items-center">
                    <form action="{{ route('castes.index') }}" method="get" class="flex items-center">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search castes by name" class="mr-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button class="btn btn-primary px-4 py-2" type="submit">Search</button>
                        @if(request('search'))
                            <a href="{{ route('castes.index') }}" class="btn btn-secondary ml-2 px-4 py-2">Clear</a>
                        @endif
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                
                                <th>Caste Name</th>
                                <th>No. of Sub-Castes</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($castes as $caste)
                            <tr>                    
                                <td>{{ $caste->name }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $caste->sub_castes_count ?? 0 }}</span>
                                </td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2" >
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-edit-button :link=" route('castes.edit', $caste->id)" />                               
                                        </li>
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-delete-button :link=" route('castes.destroy',$caste->id)" />  
                                        </li>   
                                    </ul>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    @if(request('search'))
                                        <p class="text-gray-500">No castes found matching "{{ request('search') }}"</p>
                                        <a href="{{ route('castes.index') }}" class="text-blue-500 hover:underline">Show all castes</a>
                                    @else
                                        <p class="text-gray-500">No castes found</p>
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $castes->links() }}
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
