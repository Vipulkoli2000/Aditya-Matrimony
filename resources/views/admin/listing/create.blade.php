<x-layout.admin>
    <div class="flex items-center justify-between mb-5">
        <h5 class="font-semibold text-lg dark:text-white-light">Add New Wedding Listing</h5>
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

        <form id="listingForm" action="{{ route('listing.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Location Fields - Category, Country, State, City in one row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-5">
                <!-- Listing Category -->
                <div>
                    <label for="listing_category_id">Listing Category<span class="text-danger">*</span></label>
                    <select id="listing_category_id" name="listing_category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('listing_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->listing_category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Country -->
                <div>
                    <label for="country">Country<span class="text-danger">*</span></label>
                    <input type="hidden" name="country" value="India">
                    <select id="country" class="form-select" disabled>
                        <option value="India" selected>India</option>
                    </select>
                </div>

                <!-- State -->
                <div>
                    <label for="state">State<span class="text-danger">*</span></label>
                    <input type="hidden" name="state" value="Maharashtra">
                    <select id="state" class="form-select" disabled>
                        <option value="Maharashtra" selected>Maharashtra</option>
                    </select>
                </div>
                
                <!-- City -->
                <div>
                    <label for="city">City<span class="text-danger">*</span></label>
                    <input id="city" type="text" name="city" class="form-input" value="{{ old('city') }}" required>
                </div>
            </div>

            <!-- Other Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                <!-- Business Name -->
                <div>
                    <label for="business_name">Business Name<span class="text-danger">*</span></label>
                    <input id="business_name" type="text" name="business_name" class="form-input" value="{{ old('business_name') }}" required>
                </div>

                <!-- Contact Person -->
                <div>
                    <label for="contact_person">Contact Person<span class="text-danger">*</span></label>
                    <input id="contact_person" type="text" name="contact_person" class="form-input" value="{{ old('contact_person') }}" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" class="form-input" value="{{ old('email') }}">
                    <p class="text-xs text-gray-500 mt-1">At least one of Email or Mobile is required.</p>
                </div>

                <!-- Mobile -->
                <div>
                    <label for="mobile">Mobile</label>
                    <input id="mobile" type="text" name="mobile" class="form-input" value="{{ old('mobile') }}">
                </div>
            </div>

            <!-- Address -->
            <div>
                <label for="address">Address<span class="text-danger">*</span></label>
                <input id="address" type="text" name="address" class="form-input" value="{{ old('address') }}" required>
            </div>

            <!-- Description -->
            <div>
                <label for="description">Description<span class="text-danger">*</span></label>
                <textarea id="description" name="description" class="form-textarea" rows="4" required>{{ old('description') }}</textarea>
            </div>

            <!-- Photo Upload -->
            <div>
                <label for="photo">Photo</label>
                <input id="photo" type="file" name="photo" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold file:bg-primary/90 file:text-white hover:file:bg-primary">
                <p class="text-xs text-gray-500 mt-1">Upload a photo (JPG, PNG, GIF - max 2MB)</p>
            </div>

            <button type="submit" class="btn btn-primary !mt-6">Create Listing</button>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.getElementById('listingForm');
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
