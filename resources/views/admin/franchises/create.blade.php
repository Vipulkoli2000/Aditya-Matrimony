<x-layout.admin>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Add New Franchise</h5>
                <a href="{{ route('admin.franchises.index') }}" class="btn btn-secondary">Back to List</a>
            </div>

            <form action="{{ route('admin.franchises.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Name -->
                    <div>
                        <label for="name" class="font-semibold">Name <span class="text-red-500">*</span></label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" 
                               class="form-input @error('name') border-red-500 @enderror" 
                               placeholder="Enter franchise name" required>
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="font-semibold">Email <span class="text-red-500">*</span></label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" 
                               class="form-input @error('email') border-red-500 @enderror" 
                               placeholder="Enter email address" required>
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mobile -->
                    <div>
                        <label for="mobile" class="font-semibold">Mobile <span class="text-red-500">*</span></label>
                        <input id="mobile" type="text" name="mobile" value="{{ old('mobile') }}" 
                               class="form-input @error('mobile') border-red-500 @enderror" 
                               placeholder="Enter mobile number" required>
                        @error('mobile')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="font-semibold">Location <span class="text-red-500">*</span></label>
                        <input id="location" type="text" name="location" value="{{ old('location') }}" 
                               class="form-input @error('location') border-red-500 @enderror" 
                               placeholder="Enter location" required>
                        @error('location')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Franchise Code -->
                    <div>
                        <label for="franchise_code" class="font-semibold">Franchise Code</label>
                        <input id="franchise_code" type="text" name="franchise_code" value="{{ old('franchise_code') }}" 
                               class="form-input @error('franchise_code') border-red-500 @enderror" 
                               placeholder="Leave empty to auto-generate">
                        @error('franchise_code')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                        <div class="text-sm text-gray-500 mt-1">Leave empty to auto-generate a unique code</div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="font-semibold">Password <span class="text-red-500">*</span></label>
                        <input id="password" type="password" name="password" 
                               class="form-input @error('password') border-red-500 @enderror" 
                               placeholder="Enter password" required>
                        @error('password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="font-semibold">Confirm Password <span class="text-red-500">*</span></label>
                        <input id="password_confirmation" type="password" name="password_confirmation" 
                               class="form-input @error('password_confirmation') border-red-500 @enderror" 
                               placeholder="Confirm password" required>
                        @error('password_confirmation')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="font-semibold">Address <span class="text-red-500">*</span></label>
                    <textarea id="address" name="address" rows="3" 
                              class="form-textarea @error('address') border-red-500 @enderror" 
                              placeholder="Enter full address" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Active Status -->
                <div class="flex items-center space-x-2">
                    <input id="active" type="checkbox" name="active" value="1" 
                           {{ old('active') ? 'checked' : 'checked' }} class="form-checkbox">
                    <label for="active" class="font-semibold">Active</label>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center space-x-3 pt-3">
                    <button type="submit" class="btn btn-primary">Create Franchise</button>
                    <a href="{{ route('admin.franchises.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layout.admin>