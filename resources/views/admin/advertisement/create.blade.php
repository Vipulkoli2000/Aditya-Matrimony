<x-layout.admin>
    <div class="container-fluid py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Page Header -->
        <div class="text-center mb-4">
            <h1 class="h2 text-primary fw-bold">
                <i class="fas fa-ad me-2"></i>Advertisement Management
            </h1>
            <p class="text-muted">Upload and manage advertisement images</p>
        </div>
        
        <!-- Image Guidelines at Top -->
        <div class="mb-5">
            <h5 class="mb-3 text-center"><i class="fas fa-info-circle text-primary me-2"></i>Image Guidelines</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-ruler-combined fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Dimensions</h6>
                                <small class="text-muted">
                                    <strong>Main Ad:</strong> 375×200px (1.875:1) • <strong>Carousel:</strong> 800×400px (2:1)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-file-image fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">File Requirements</h6>
                                <small class="text-muted">
                                    <strong>Formats:</strong> JPEG, PNG, WEBP • <strong>Max Size:</strong> 2MB per file
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Upload Form -->
        <form action="{{ route('admin.advertisement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Main Advertisement Section -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-image me-2"></i>Main Advertisement</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Upload New Image</label>
                            <input type="file" name="advertisement_1" class="form-control mb-2" accept="image/*">
                            @error('advertisement_1')
                                <small class="text-danger d-block"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                            @enderror
                            <small class="text-muted">Recommended: 375×200px, Max 2MB (JPEG, PNG, WEBP)</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Current Image</label>
                            <div class="border rounded p-3 text-center bg-light">
                                @if($advertisement->advertisement_1)
                                    <div x-data="imageLoader()" x-init="fetchImage('{{ $advertisement->advertisement_1 }}')">
                                        <template x-if="imageUrl">
                                            <img :src="imageUrl" 
                                                 alt="Advertisement 1" 
                                                 class="img-fluid rounded" 
                                                 style="max-height: 150px; object-fit: contain;">
                                        </template>
                                        <template x-if="!imageUrl">
                                            <div class="py-4">
                                                <i class="fas fa-spinner fa-spin fa-2x text-muted mb-3"></i>
                                                <p class="text-muted mb-0">Loading image...</p>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="mt-2">
                                        <span class="badge bg-success">Custom Image</span>
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-danger" onclick="removeAdvertisement('advertisement_1')">
                                                <i class="fas fa-trash-alt me-1"></i>Remove Ad
                                            </button>
                                        </div>
                                    </div>
                                @elseif(file_exists(public_path('assets/images/ad-1.jpeg')))
                                    <img src="{{ asset('assets/images/ad-1.jpeg') }}" 
                                         alt="Advertisement 1" 
                                         class="img-fluid rounded" 
                                         style="max-height: 150px; object-fit: contain;">
                                    <div class="mt-2">
                                        <span class="badge bg-secondary">Default Image</span>
                                    </div>
                                @else
                                    <div class="py-4">
                                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                        <p class="text-muted mb-0">No advertisement uploaded</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Carousel Images Section -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-images me-2"></i>Carousel Images</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="col-md-6">
                                <div class="border rounded p-3">
                                    <h6 class="mb-3">Carousel Image {{ $i }}</h6>
                                    <div class="mb-3">
                                        <input type="file" name="carousel_{{ $i }}" class="form-control" accept="image/*">
                                        @error('carousel_' . $i)
                                            <small class="text-danger d-block mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                                        @enderror
                                        <small class="text-muted d-block mt-1">Recommended: 800x400px, Max 2MB (JPEG, PNG, WEBP)</small>
                                    </div>
                                    <div class="text-center bg-light rounded p-3">
                                        @if($advertisement->{'carousel_' . $i})
                                            <div x-data="imageLoader()" x-init="fetchImage('{{ $advertisement->{'carousel_' . $i} }}')">
                                                <template x-if="imageUrl">
                                                    <img :src="imageUrl" 
                                                         alt="Carousel {{ $i }}" 
                                                         class="img-fluid rounded" 
                                                         style="max-height: 120px; object-fit: contain;">
                                                </template>
                                                <template x-if="!imageUrl">
                                                    <div class="py-3">
                                                        <i class="fas fa-spinner fa-spin fa-2x text-muted mb-2"></i>
                                                        <p class="text-muted mb-0 small">Loading image...</p>
                                                    </div>
                                                </template>
                                            </div>
                                            <div class="mt-2">
                                                <span class="badge bg-success">Custom</span>
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeAdvertisement('carousel_{{ $i }}')">
                                                        <i class="fas fa-trash-alt me-1"></i>Remove
                                                    </button>
                                                </div>
                                            </div>
                                        @elseif(file_exists(public_path('assets/images/carousel-' . $i . '.jpeg')))
                                            <img src="{{ asset('assets/images/carousel-' . $i . '.jpeg') }}" 
                                                 alt="Carousel {{ $i }}" 
                                                 class="img-fluid rounded" 
                                                 style="max-height: 120px; object-fit: contain;">
                                            <div class="mt-2">
                                                <span class="badge bg-secondary">Default</span>
                                            </div>
                                        @else
                                            <div class="py-3">
                                                <i class="fas fa-image fa-2x text-muted mb-2"></i>
                                                <p class="text-muted mb-0 small">No advertisement uploaded</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-save me-2"></i>Update All Advertisements
                </button>
            </div>
        </form>
    </div>
    
    <!-- Hidden form for removing advertisements -->
    <form id="removeAdForm" action="{{ route('admin.advertisement.remove') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="ad_type" id="ad_type_input">
    </form>
    
    <!-- Custom Styles -->
    <style>
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-2px);
        }
        .badge {
            font-weight: 500;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .btn-danger {
            transition: all 0.3s ease;
        }
        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(220, 53, 69, 0.3);
        }
    </style>
    
    <!-- Alpine.js Scripts -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Alpine.js Image Loader Function -->
    <script>
        function imageLoader() {
            return {
                imageUrl: null,
                async fetchImage(filename) {
                    console.log('Admin: Fetching image:', filename);
                    try {
                        const url = `/api/images/${filename}`;
                        console.log('Admin: Request URL:', url);
                        const response = await fetch(url);
                        console.log('Admin: Response status:', response.status);
                        if (!response.ok) {
                            console.error('Admin: Response not ok:', response.status, response.statusText);
                            throw new Error(`Image not found: ${response.status}`);
                        }
                        const blob = await response.blob();
                        this.imageUrl = URL.createObjectURL(blob);
                        console.log('Admin: Image loaded successfully');
                    } catch (error) {
                        console.error('Admin: Error fetching image:', error);
                        this.imageUrl = null;
                    }
                }
            };
        }
    </script>
    
    <!-- JavaScript for remove functionality -->
    <script>
        function removeAdvertisement(adType) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will remove the custom advertisement image!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('ad_type_input').value = adType;
                    document.getElementById('removeAdForm').submit();
                }
            });
        }
    </script>
</x-layout.admin>
