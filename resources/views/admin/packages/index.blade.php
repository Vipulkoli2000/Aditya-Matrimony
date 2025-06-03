<x-layout.admin>
    <x-add-button :link="route('packages.create')" />
    @role(['admin'])
    {{-- <x-excel-button :link="route('sub_castes.import')" /> --}}
    <x-excel-button :link="route('packages.import')" />
@endrole    
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Packages</h5>
                <div class="flex items-center">
                    <form action="" method="get" class="flex items-center">
                        <input type="text" name="search" placeholder="search packages" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th style="text-align:right;">Name</th>
                                <th style="text-align:right;">Description</th>
                                <th style="text-align:right;">Price (INR)</th>
                                <th style="text-align:right;">Tokens</th>
                                <th style="text-align:right;">Validity (days)</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                            <tr>                    
                                <td>{{ $package->id }}</td>
                                <td style="text-align:right;"> {{ $package->name }}</td>
                                <td style="text-align:right;"> {{ $package->description }}</td>
                                <td style="text-align:right;"> {{ $package->price }}</td>
                                <td style="text-align:right;"> {{ $package->tokens }}</td>
                                <td style="text-align:right;"> {{ $package->validity }} days</td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2" >
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-edit-button :link=" route('packages.edit', $package->id)" />                               
                                        </li>
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-delete-button :link=" route('packages.destroy',$package->id)" />  
                                        </li>   
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $packages->links() }}
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
