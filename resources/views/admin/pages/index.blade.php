<x-layout.admin>
    <x-add-button :link="route('pages.create')" />
    @role(['admin'])
    {{-- <x-excel-button :link="route('sub_castes.import')" /> --}}
    {{-- <x-excel-button :link="route('packages.import')" /> --}}
@endrole    
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            {{-- <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Pages</h5>
                <div class="flex items-center">
                    <form action="" method="get" class="flex items-center">
                        <input type="text" name="search" placeholder="search pages" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
                    </form>
                </div>
            </div> --}}
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Page</th>
                                <th>Slug</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                            <tr>                    
                                <td> {{ $page->title }}</td>
                                <td> {{ $page->slug }}</td>

                                <td class="float-right">
                                    <ul class="flex items-center gap-2" >
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-edit-button :link=" route('pages.edit', $page->id)" />                               
                                        </li>
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-delete-button :link=" route('pages.destroy',$page->id)" />  
                                        </li>   
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pages->links() }}
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
