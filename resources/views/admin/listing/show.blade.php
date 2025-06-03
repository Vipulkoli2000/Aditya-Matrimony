<x-layout.admin>
    <div class="flex items-center justify-between mb-5">
        <h5 class="font-semibold text-lg dark:text-white-light">View Wedding Listing</h5>
        <div class="flex items-center gap-2">
            <a href="{{ route('listing.edit', $listing->id) }}" class="btn btn-primary w-auto px-3">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                    <path d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z" stroke="currentColor" stroke-width="1.5" />
                    <path opacity="0.5" d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015" stroke="currentColor" stroke-width="1.5" />
                </svg>
                Edit
            </a>
            <a href="{{ route('listing.index') }}" class="btn btn-outline-primary w-auto px-3">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                    <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Back
            </a>
        </div>
    </div>

    <div class="panel">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Column - Photo -->
            <div class="md:col-span-1">
                @if($listing->photo)
                <div class="mb-6">
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
                    
                    @if($imageData)
                        <img src="{{ $src }}" alt="{{ $listing->business_name }}" class="w-full h-auto rounded-lg shadow-lg">
                    @else
                        <div class="flex items-center justify-center h-64 bg-gray-100 text-gray-500 rounded-lg">
                            <div class="text-center">
                                <p class="mb-2">Image not found</p>
                                <p class="text-xs">File: {{ $listing->photo }}</p>
                                <p class="text-xs">Path checked: {{ $imagePath }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                @else
                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                    <span class="text-gray-500">No photo available</span>
                </div>
                @endif
            </div>

            <!-- Right Column - Details -->
            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold text-primary">{{ $listing->business_name }}</h2>
                        <p class="text-sm text-gray-500">{{ $listing->category->listing_category }}</p>
                    </div>

                    <div class="text-right">
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-success text-white">
                            <span>Active</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-semibold">Contact Person</h3>
                            <p>{{ $listing->contact_person }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold">Contact Information</h3>
                            <p>{{ $listing->email }}</p>
                            <p>{{ $listing->mobile }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold">Location</h3>
                        <p>{{ $listing->address }}</p>
                        <p>{{ $listing->city }}, {{ $listing->state }}, {{ $listing->country }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold">Description</h3>
                        <div class="p-4 bg-gray-50 rounded-lg mt-2">
                            <p>{{ $listing->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layout.admin>
