<x-layout.admin>
    <x-add-button :link="route('cities.create')" />
    @role(['admin'])
        {{-- <x-excel-button :link="route('cities.import')" /> --}}
    @endrole    
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Cities</h5>
                <div class="flex items-center">
                    <form action="" method="get" class="flex items-center">
                        <input type="text" name="search" placeholder="search cities" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th style="text-align:right;">Name</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                            <tr>                    
                                <td>{{ $city->id }}</td>
                                <td style="text-align:right;"> {{ $city->name }}</td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2" >
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-edit-button :link=" route('cities.edit', $city->id)" />                               
                                        </li>
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-delete-button :link=" route('cities.destroy',$city->id)" />  
                                        </li>   
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $cities->links() }}
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
