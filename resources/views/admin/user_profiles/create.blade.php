<x-layout.admin>
    <div class="panel">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-6">Add Profile</h1>
        
        <!-- Display validation errors, if any -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('user_profiles.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">     

            
            <div>
                <label for="first_name" class="block text-sm font-medium">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Enter First Name..." required>
            </div>
            
            <div>
                <label for="middle_name" class="block text-sm font-medium">Middle Name</label>
                <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Enter Middle Name...">
            </div>
            
            <div>
                <label for="last_name" class="block text-sm font-medium">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Enter Last Name...">
            </div>
            
            <div>
                <label for="role" class="block text-sm font-medium">Role</label>
                <select name="role" id="role" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    <option value="">Select Role</option>
                    <option value="bride" {{ old('role') == 'bride' ? 'selected' : '' }}>Bride</option>
                    <option value="groom" {{ old('role') == 'groom' ? 'selected' : '' }}>Groom</option>
                </select>
            </div>
            
            <div>
                <label for="mobile" class="block text-sm font-medium">Mobile</label>
                <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md" placeholder="e.g., 9876543210" required>
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Enter Email..." required>
            </div>
        </div>
            
            <!-- Password is fixed to "Aditya123" so no input field is needed -->

            <div>
                <label for="package_id" class="block text-sm font-medium">Select Package</label>
                <select name="package_id" id="package_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    <option value="">Select Package</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                            {{ $package->name }} (Tokens: {{ $package->tokens }}, Validity: {{ $package->validity }} days)
                        </option>
                    @endforeach
                </select>
            </div>
          
            
            <div>
                <button type="submit" class="btn btn-primary px-4 py-2">
                    Add Profile
                </button>
            </div>
        </form>
    </div>
    </div>
</x-layout.admin>
