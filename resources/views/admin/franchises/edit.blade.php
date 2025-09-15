<x-layout.admin>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Edit Franchise</h5>
                <a href="{{ route('admin.franchises.index') }}" class="btn btn-secondary">Back to List</a>
            </div>

            <form action="{{ route('admin.franchises.update', $franchise->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Name -->
                    <div>
                        <label for="name" class="font-semibold">Name <span class="text-red-500">*</span></label>
                        <input id="name" type="text" name="name" value="{{ old('name', $franchise->name) }}" 
                               class="form-input @error('name') border-red-500 @enderror" 
                               placeholder="Enter franchise name" required>
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="font-semibold">Email <span class="text-red-500">*</span></label>
                        <input id="email" type="email" name="email" value="{{ old('email', $franchise->email) }}" 
                               class="form-input @error('email') border-red-500 @enderror" 
                               placeholder="Enter email address" required>
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mobile -->
                    <div>
                        <label for="mobile" class="font-semibold">Mobile <span class="text-red-500">*</span></label>
                        <input id="mobile" type="text" name="mobile" value="{{ old('mobile', $franchise->mobile) }}" 
                               class="form-input @error('mobile') border-red-500 @enderror" 
                               placeholder="Enter mobile number" required>
                        @error('mobile')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="font-semibold">Location <span class="text-red-500">*</span></label>
                        <input id="location" type="text" name="location" value="{{ old('location', $franchise->location) }}" 
                               class="form-input @error('location') border-red-500 @enderror" 
                               placeholder="Enter location" required>
                        @error('location')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Franchise Code -->
                    <div>
                        <label for="franchise_code" class="font-semibold">Franchise Code <span class="text-red-500">*</span></label>
                        <input id="franchise_code" type="text" name="franchise_code" value="{{ old('franchise_code', $franchise->franchise_code) }}" 
                               class="form-input @error('franchise_code') border-red-500 @enderror" 
                               placeholder="Enter franchise code" required>
                        @error('franchise_code')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="font-semibold">New Password</label>
                        <input id="password" type="password" name="password" 
                               class="form-input @error('password') border-red-500 @enderror" 
                               placeholder="Enter new password (leave empty to keep current)">
                        @error('password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                        <div class="text-sm text-gray-500 mt-1">Leave empty to keep current password</div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="font-semibold">Confirm New Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" 
                               class="form-input @error('password_confirmation') border-red-500 @enderror" 
                               placeholder="Confirm new password">
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
                              placeholder="Enter full address" required>{{ old('address', $franchise->address) }}</textarea>
                    @error('address')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Active Status -->
                <div class="flex items-center space-x-2">
                    <input id="active" type="checkbox" name="active" value="1" 
                           {{ old('active', $franchise->active) ? 'checked' : '' }} class="form-checkbox">
                    <label for="active" class="font-semibold">Active</label>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center space-x-3 pt-3">
                    <button type="submit" class="btn btn-primary">Update Franchise</button>
                    <a href="{{ route('admin.franchises.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layout.admin>