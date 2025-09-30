<x-layout.admin>
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Franchise Details</h5>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.franchises.edit', $franchise->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('admin.franchises.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-4">
                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                    <h6 class="font-semibold text-md mb-3">Basic Information</h6>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="font-semibold text-sm text-gray-600 dark:text-gray-400">Name</label>
                            <div class="text-lg">{{ $franchise->name }}</div>
                        </div>

                        <div>
                            <label class="font-semibold text-sm text-gray-600 dark:text-gray-400">Email</label>
                            <div class="text-lg">{{ $franchise->email }}</div>
                        </div>

                        <div>
                            <label class="font-semibold text-sm text-gray-600 dark:text-gray-400">Mobile</label>
                            <div class="text-lg">{{ $franchise->mobile }}</div>
                        </div>

                        <div>
                            <label class="font-semibold text-sm text-gray-600 dark:text-gray-400">Location</label>
                            <div class="text-lg">{{ $franchise->location }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                    <h6 class="font-semibold text-md mb-3">Address</h6>
                    <div class="text-lg whitespace-pre-line">{{ $franchise->address }}</div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                    <h6 class="font-semibold text-md mb-3">Franchise Information</h6>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="font-semibold text-sm text-gray-600 dark:text-gray-400">Franchise Code</label>
                            <div>
                                <span class="badge badge-outline-primary text-lg">{{ $franchise->franchise_code }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="font-semibold text-sm text-gray-600 dark:text-gray-400">Status</label>
                            <div>
                                @if($franchise->active)
                                    <span class="badge badge-outline-success">Active</span>
                                @else
                                    <span class="badge badge-outline-danger">Inactive</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                    <h6 class="font-semibold text-md mb-3">Account Information</h6>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="font-semibold text-sm text-gray-600 dark:text-gray-400">Created At</label>
                            <div class="text-lg">{{ $franchise->created_at->format('d-m-Y, h:i A') }}</div>
                        </div>

                        <div>
                            <label class="font-semibold text-sm text-gray-600 dark:text-gray-400">Updated At</label>
                            <div class="text-lg">{{ $franchise->updated_at->format('d-m-Y, h:i A') }}</div>
                        </div>

                        @if($franchise->email_verified_at)
                        <div>
                            <label class="font-semibold text-sm text-gray-600 dark:text-gray-400">Email Verified At</label>
                            <div class="text-lg">{{ $franchise->email_verified_at->format('d-m-Y, h:i A') }}</div>
                        </div>
                        @else
                        <div>
                            <label class="font-semibold text-sm text-gray-600 dark:text-gray-400">Email Status</label>
                            <div>
                                <span class="badge badge-outline-warning">Not Verified</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-center space-x-3 mt-6 pt-6 border-t">
            <a href="{{ route('admin.franchises.edit', $franchise->id) }}" class="btn btn-primary">
                <i class="fas fa-edit mr-2"></i>Edit Franchise
            </a>
            
            <a href="{{ route('admin.franchises.toggle-status', $franchise->id) }}" 
               class="btn {{ $franchise->active ? 'btn-warning' : 'btn-success' }}"
               onclick="return confirm('Are you sure you want to {{ $franchise->active ? 'deactivate' : 'activate' }} this franchise?')">
                <i class="fas fa-power-off mr-2"></i>
                {{ $franchise->active ? 'Deactivate' : 'Activate' }}
            </a>

            <form action="{{ route('admin.franchises.destroy', $franchise->id) }}" method="POST" class="inline"
                  onsubmit="return confirm('Are you sure you want to delete this franchise? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash mr-2"></i>Delete Franchise
                </button>
            </form>
        </div>
    </div>
</x-layout.admin>