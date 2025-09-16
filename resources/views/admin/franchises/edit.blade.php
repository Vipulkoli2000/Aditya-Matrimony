<x-layout.admin>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Edit Franchise</h5>
                <a href="{{ route('admin.franchises.index') }}" class="btn btn-secondary">Back to List</a>
            </div>

            <form action="{{ route('admin.franchises.update', $franchise->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Basic Information Section -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg">
                    <h6 class="text-lg font-semibold mb-6 text-gray-800 dark:text-white-light border-b border-gray-200 dark:border-gray-700 pb-2">
                        Basic Information
                    </h6>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="space-y-2">
                            <label for="name" class="block font-semibold text-gray-700 dark:text-white-light">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input id="name" type="text" name="name" value="{{ old('name', $franchise->name) }}" 
                                   class="form-input @error('name') border-red-500 @enderror" 
                                   placeholder="Enter franchise name" required>
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="block font-semibold text-gray-700 dark:text-white-light">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email', $franchise->email) }}" 
                                   class="form-input @error('email') border-red-500 @enderror" 
                                   placeholder="Enter email address" required>
                            @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mobile -->
                        <div class="space-y-2">
                            <label for="mobile" class="block font-semibold text-gray-700 dark:text-white-light">
                                Mobile <span class="text-red-500">*</span>
                            </label>
                            <input id="mobile" type="text" name="mobile" value="{{ old('mobile', $franchise->mobile) }}" 
                                   class="form-input @error('mobile') border-red-500 @enderror" 
                                   placeholder="Enter mobile number" required>
                            @error('mobile')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="space-y-2">
                            <label for="location" class="block font-semibold text-gray-700 dark:text-white-light">
                                Location <span class="text-red-500">*</span>
                            </label>
                            <input id="location" type="text" name="location" value="{{ old('location', $franchise->location) }}" 
                                   class="form-input @error('location') border-red-500 @enderror" 
                                   placeholder="Enter location" required>
                            @error('location')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Franchise Code -->
                        <div class="space-y-2 md:col-span-2">
                            <label for="franchise_code" class="block font-semibold text-gray-700 dark:text-white-light">
                                Franchise Code <span class="text-red-500">*</span>
                            </label>
                            <input id="franchise_code" type="text" name="franchise_code" value="{{ old('franchise_code', $franchise->franchise_code) }}" 
                                   class="form-input @error('franchise_code') border-red-500 @enderror" 
                                   placeholder="Enter franchise code" required>
                            @error('franchise_code')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Security Section -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg">
                    <h6 class="text-lg font-semibold mb-6 text-gray-800 dark:text-white-light border-b border-gray-200 dark:border-gray-700 pb-2">
                        Security Settings
                    </h6>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div class="space-y-2">
                            <label for="password" class="block font-semibold text-gray-700 dark:text-white-light">
                                New Password
                            </label>
                            <input id="password" type="password" name="password" 
                                   class="form-input @error('password') border-red-500 @enderror" 
                                   placeholder="Enter new password (leave empty to keep current)">
                            @error('password')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                            <div class="text-sm text-gray-500 mt-1">Leave empty to keep current password</div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block font-semibold text-gray-700 dark:text-white-light">
                                Confirm New Password
                            </label>
                            <input id="password_confirmation" type="password" name="password_confirmation" 
                                   class="form-input @error('password_confirmation') border-red-500 @enderror" 
                                   placeholder="Confirm new password">
                            @error('password_confirmation')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Address Section -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg">
                    <h6 class="text-lg font-semibold mb-6 text-gray-800 dark:text-white-light border-b border-gray-200 dark:border-gray-700 pb-2">
                        Address Information
                    </h6>
                    <div class="space-y-2">
                        <label for="address" class="block font-semibold text-gray-700 dark:text-white-light">
                            Address <span class="text-red-500">*</span>
                        </label>
                        <textarea id="address" name="address" rows="4" 
                                  class="form-textarea @error('address') border-red-500 @enderror" 
                                  placeholder="Enter full address" required>{{ old('address', $franchise->address) }}</textarea>
                        @error('address')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Status Section -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg">
                    <h6 class="text-lg font-semibold mb-6 text-gray-800 dark:text-white-light border-b border-gray-200 dark:border-gray-700 pb-2">
                        Status Settings
                    </h6>
                    <div class="flex items-center space-x-3">
                        <input id="active" type="checkbox" name="active" value="1" 
                               {{ old('active', $franchise->active) ? 'checked' : '' }} class="form-checkbox">
                        <label for="active" class="font-semibold text-gray-700 dark:text-white-light">Active</label>
                        <span class="text-sm text-gray-500">Check to activate this franchise</span>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.franchises.index') }}" class="btn btn-secondary" style="margin-right: 2rem;">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Franchise</button>
                </div>
            </form>
        </div>
    </div>
</x-layout.admin>