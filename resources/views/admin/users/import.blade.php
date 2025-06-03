<x-layout.admin>  
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('users.index') }}" class="text-primary hover:underline">Users</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Import</span>
        </li>
    </ul>       
    <div class="pt-5">
        <form action="{{ route('importUsersExcel')  }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Import Excel</h5>
                </div> 
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-5">
                    <div>
                        <input type="file" name="file" class="form-input" >
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>  
                    <div>
                        <button class="btn btn-primary m-1" >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 003 3.5v13A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.5-1.5V7.621a1.5 1.5 0 00-.44-1.06l-4.12-4.122A1.5 1.5 0 0011.378 2H4.5zm4.75 6.75a.75.75 0 011.5 0v2.546l.943-1.048a.75.75 0 011.114 1.004l-2.25 2.5a.75.75 0 01-1.114 0l-2.25-2.5a.75.75 0 111.114-1.004l.943 1.048V8.75z" clip-rule="evenodd" />
                            </svg> Import
                        </button>
                    </div> 
                    <!-- <div>
                        <a href="{{ asset('files/employee_template.xls') }}" class="btn btn-success gap-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5">
                            <path opacity="0.5"
                                d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        Download Template </a>
                    </div> -->
                </div>
            </div>
        </form>
    </div>    
</x-layout.admin>
