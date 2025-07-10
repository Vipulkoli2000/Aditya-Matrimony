<x-layout.admin>
    <x-add-button :link="route('sub_castes.create')" />
    @role(['admin'])
        {{-- <x-excel-button :link="route('sub_castes.import')" /> --}}
    @endrole    
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Sub-Castes</h5>
                <div class="flex items-center">
                    <form action="{{ route('sub_castes.index') }}" method="get" class="flex items-center">
                        <input type="text" name="search" placeholder="search sub-castes or caste" class="mr-2 px-2 py-1 border border-gray-300 rounded-md" value="{{ request('search') }}">
                        <button class="btn btn-primary px-4 py-2" type="submit">Search</button>
                        @if(request('search'))
                            <a href="{{ route('sub_castes.index') }}" class="btn btn-secondary ml-2">Clear</a>
                        @endif
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Caste</th>
                                <th>Sub-Caste Name</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sub_castes as $sub_caste)
                            <tr>                    
                                <td>{{ $sub_caste->id }}</td>
                                <td>{{ $sub_caste->caste ? $sub_caste->caste->name : 'N/A' }}</td>
                                <td>{{ $sub_caste->name }}</td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2" >
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-edit-button :link=" route('sub_castes.edit', $sub_caste->id)" />                               
                                        </li>
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-delete-button :link=" route('sub_castes.destroy',$sub_caste->id)" />  
                                        </li>   
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sub_castes->links() }}
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
