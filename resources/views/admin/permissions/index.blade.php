<x-layout.admin>
    <x-add-button :link="route('permissions.create')" :text="'Generate'"/>
    <br><br>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Permission</h5>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Guard Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $permission)
                            <tr>                    
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                                <!-- <td>
                                    <div style="display:inline-block;">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('permissions.edit', $permission->id)}}" >Edit</a>
                                        <form class="space-y-5" action="{{ route('permissions.destroy',$permission->id) }}"   method="POST">                            
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td> -->
                            </tr>
                        @endforeach
                        </tbody>
                    </div>
                </div>
            </table>
            {{ $permissions->links() }}
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
