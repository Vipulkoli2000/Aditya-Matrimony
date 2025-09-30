<x-layout.admin>
    <div class="flex justify-between">
        @role(['admin'])
            {{-- Keep space for future actions like export/import if needed --}}
        @endrole   
    </div> 
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Update Transaction Status</h5>
                <div class="flex items-center">
                    <a href="{{ route('profile_packages.pending') }}" class="btn btn-secondary px-4 py-2">Back to Pending Transactions</a>
                </div>
            </div>
            
            @if($errors->any())
                <div class="alert alert-danger mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Transaction Details Card -->
                <div class="panel">
                    <div class="panel-header">
                        <h6 class="font-semibold mb-4">Transaction Details</h6>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <label class="font-medium text-gray-700">User Name:</label>
                            <span class="ml-2">{{ optional($profilePackage->profile->user)->name }}</span>
                        </div>
                        <div>
                            <label class="font-medium text-gray-700">Email:</label>
                            <span class="ml-2">{{ optional($profilePackage->profile->user)->email }}</span>
                        </div>
                        <div>
                            <label class="font-medium text-gray-700">Mobile:</label>
                            <span class="ml-2">{{ optional($profilePackage->profile)->mobile }}</span>
                        </div>
                        <div>
                            <label class="font-medium text-gray-700">Package Name:</label>
                            <span class="ml-2">{{ optional($profilePackage->package)->name }}</span>
                        </div>
                        <div>
                            <label class="font-medium text-gray-700">Order ID:</label>
                            <span class="ml-2">{{ $profilePackage->order_id ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <label class="font-medium text-gray-700">Tokens:</label>
                            <span class="ml-2">{{ $profilePackage->tokens_received }}</span>
                        </div>
                        <div>
                            <label class="font-medium text-gray-700">Current Status:</label>
                            <span class="ml-2 badge bg-warning text-dark">Pending</span>
                        </div>
                        <div>
                            <label class="font-medium text-gray-700">Created At:</label>
                            <span class="ml-2">{{ $profilePackage->created_at->format('d-m-Y H:i:s') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Update Status Form -->
                <div class="panel">
                    <div class="panel-header">
                        <h6 class="font-semibold mb-4">Update Status</h6>
                    </div>
                    <form action="{{ route('profile_packages.update_status', $profilePackage->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="payment_ref_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Payment Reference ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="payment_ref_id" 
                                   name="payment_ref_id" 
                                   value="{{ old('payment_ref_id', $profilePackage->payment_ref_id) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter payment reference ID"
                                   required>
                            @error('payment_ref_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                            <p class="text-sm text-blue-800">
                                <strong>Note:</strong> After saving the payment reference ID, the status will be automatically updated to "Success" and the user will receive the purchased tokens.
                            </p>
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('profile_packages.pending') }}" class="btn btn-secondary px-6 py-2">Cancel</a>
                            <button type="submit" class="btn btn-success px-6 py-2">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .badge {
            padding: 0.25em 0.5em;
            border-radius: 0.25rem;
            font-size: 0.875em;
            font-weight: 600;
        }
        .bg-warning {
            background-color: #ffc107;
        }
        .text-dark {
            color: #212529;
        }
        .alert {
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .alert-danger ul {
            margin: 0;
            padding-left: 1.2rem;
        }
        .panel {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }
    </style>
    
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
