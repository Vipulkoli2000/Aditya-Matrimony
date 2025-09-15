<x-layout.admin>
    <div class="flex items-center justify-between mb-5">
        <h5 class="font-semibold text-lg dark:text-white-light">Edit Wedding Listing</h5>
        <a href="{{ route('listing.index') }}" class="btn btn-primary w-auto px-3">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Back to Listings
        </a>
    </div>

    <div class="panel">
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="listingEditForm" action="{{ route('listing.update', $listing->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Location Fields - Category, Country, State, City in one row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-5">
                <!-- Listing Category -->
                <div>
                    <label for="listing_category_id">Listing Category<span class="text-danger">*</span></label>
                    <select id="listing_category_id" name="listing_category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('listing_category_id', $listing->listing_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->listing_category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Country -->
                <div>
                    <label for="country">Country<span class="text-danger">*</span></label>
                    <select id="country" name="country" class="form-select" required>
                        <option value="">Select Country</option>
                        @foreach ($countries as $key => $country)
                            <option value="{{ $country }}" {{ old('country', $listing->country) == $country ? 'selected' : '' }}>
                                {{ $country }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- State -->
                <div>
                    <label for="state">State<span class="text-danger">*</span></label>
                    <select id="state" name="state" class="form-select" required>
                        <option value="">Select State</option>
                        @foreach ($states as $key => $state)
                            <option value="{{ $state }}" {{ old('state', $listing->state) == $state ? 'selected' : '' }}>
                                {{ $state }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- City -->
                <div>
                    <label for="city">City<span class="text-danger">*</span></label>
                    <input id="city" type="text" name="city" class="form-input" value="{{ old('city', $listing->city) }}" required>
                </div>
            </div>

            <!-- Other Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- Business Name -->
                <div>
                    <label for="business_name">Business Name<span class="text-danger">*</span></label>
                    <input id="business_name" type="text" name="business_name" class="form-input" value="{{ old('business_name', $listing->business_name) }}" required>
                </div>

                <!-- Contact Person -->
                <div>
                    <label for="contact_person">Contact Person<span class="text-danger">*</span></label>
                    <input id="contact_person" type="text" name="contact_person" class="form-input" value="{{ old('contact_person', $listing->contact_person) }}" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" class="form-input" value="{{ old('email', $listing->email) }}">
                    <p class="text-xs text-gray-500 mt-1">At least one of Email or Mobile is required.</p>
                </div>

                <!-- Mobile -->
                <div>
                    <label for="mobile">Mobile</label>
                    <input id="mobile" type="text" name="mobile" class="form-input" value="{{ old('mobile', $listing->mobile) }}">
                </div>
            </div>

            <!-- Address -->
            <div>
                <label for="address">Address<span class="text-danger">*</span></label>
                <input id="address" type="text" name="address" class="form-input" value="{{ old('address', $listing->address) }}" required>
            </div>

            <!-- Description -->
            <div>
                <label for="description">Description<span class="text-danger">*</span></label>
                <textarea id="description" name="description" class="form-textarea" rows="4" required>{{ old('description', $listing->description) }}</textarea>
            </div>

            <!-- Photo Section -->
            <div>
                <label>Photo</label>
                <div class="mt-2 flex flex-row gap-6 justify-between">
                    <!-- Change Photo -->
                    <div class="flex flex-col">
                        <div class="text-sm font-medium text-gray-700 mb-1">Change Photo</div>
                        <input id="photo" type="file" name="photo" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold file:bg-primary/90 file:text-white hover:file:bg-primary">
                        <p class="text-xs text-gray-500 mt-1">Upload a photo (JPG, PNG, GIF - max 2MB)</p>
                    </div>

                    <!-- Current Photo -->
                    @if($listing->photo)
                        @php
                        // Get the image directly from storage and display it as base64
                        $imagePath = storage_path('app/public/listings/' . $listing->photo);
                        $imageData = null;
                        
                        if (file_exists($imagePath)) {
                            $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                            $validTypes = ['jpg', 'jpeg', 'png', 'gif'];
                            
                            if (in_array(strtolower($imageType), $validTypes)) {
                                $imageData = base64_encode(file_get_contents($imagePath));
                                $src = 'data:image/' . $imageType . ';base64,' . $imageData;
                            }
                        }
                        @endphp
                        
                        <div class="flex flex-col items-center">
                            <div class="text-sm font-medium text-gray-700 mb-1">Current Photo</div>
                            @if($imageData)
                                <img src="{{ $src }}" alt="{{ $listing->business_name }}" class="w-32 h-32 object-cover rounded-md" id="listing-image">
                                <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                                <button type="button" id="remove-image-btn" class="btn btn-danger mt-2 px-3 text-sm w-full" onclick="document.getElementById('remove_photo').value = '1'; this.classList.add('hidden'); document.getElementById('listing-image').classList.add('hidden'); document.getElementById('removed-message').classList.remove('hidden');">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ltr:mr-2 rtl:ml-2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                                    Remove Image
                                </button>
                                <div id="removed-message" class="hidden mt-2 text-danger text-sm">
                                    Image will be removed upon saving
                                </div>
                            @else
                                <div class="flex items-center justify-center w-32 h-32 bg-gray-100 text-gray-500 rounded-md">
                                    <div class="text-center text-xs">
                                        <p>Image not found</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary !mt-6">Update Listing</button>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.getElementById('listingEditForm');
                    if (!form) return;
                    const email = document.getElementById('email');
                    const mobile = document.getElementById('mobile');

                    function ensureEitherEmailOrMobile(e) {
                        const hasEmail = email && email.value.trim().length > 0;
                        const hasMobile = mobile && mobile.value.trim().length > 0;
                        const existing = document.getElementById('emailMobileError');
                        if (!hasEmail && !hasMobile) {
                            e.preventDefault();
                            if (!existing) {
                                const err = document.createElement('div');
                                err.id = 'emailMobileError';
                                err.className = 'text-danger text-sm mt-1';
                                err.textContent = 'Please provide at least one of Email or Mobile.';
                                mobile.parentElement.appendChild(err);
                            } else {
                                existing.classList.remove('hidden');
                            }
                            (email || mobile).focus();
                        } else if (existing) {
                            existing.classList.add('hidden');
                        }
                    }

                    form.addEventListener('submit', ensureEitherEmailOrMobile);
                    [email, mobile].forEach(function (el) {
                        if (!el) return;
                        el.addEventListener('input', function () {
                            const existing = document.getElementById('emailMobileError');
                            if (existing && (email.value.trim() || mobile.value.trim())) {
                                existing.classList.add('hidden');
                            }
                        });
                    });
                });
            </script>
        </form>
    </div>
</x-layout.admin>
