<x-layout.admin>
    <x-add-button :link="route('blocks.create')" />
    @role(['admin'])
    {{-- <x-excel-button :link="route('sub_castes.import')" /> --}}
    {{-- <x-excel-button :link="route('packages.import')" /> --}}
@endrole    
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Blocks</h5>
                {{-- <div class="flex items-center">
                    <form action="" method="get" class="flex items-center">
                        <input type="text" name="search" placeholder="search blocks" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
                    </form>
                </div> --}}
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                {{-- <th>Id</th> --}}
                                <th>Block</th>
                                {{-- <th style="text-align:right;">Description</th> --}}
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blocks as $block)
                            <tr>                    
                                {{-- <td>{{ $block->id }}</td> --}}
                                <td> {{ $block->block }}</td>
                                {{-- <td style="text-align:right;"> {{ $block->description }}</td> --}}
                                <td class="float-right">
                                    <ul class="flex items-center gap-2" >
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-edit-button :link=" route('blocks.edit', $block->id)" />                               
                                        </li>
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-delete-button :link=" route('blocks.destroy',$block->id)" />  
                                        </li>   
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $blocks->links() }}
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
                            document.querySelectorAll('pr   5e.code').forEach(el => {
                                hljs.highlightElement(el);
                            });
                        });
                    }
                }
            }));
        });
    </script>
</x-layout.admin>
