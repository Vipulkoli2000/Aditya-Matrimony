<x-layout.admin>
    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <h1 class="h4 mb-3">Update Advertisements</h1>
        
        <!-- Current Advertisements Preview -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Current Advertisement 1</div>
                    <div class="card-body text-center">
                        <img src="{{ $advertisement->advertisement_1_url }}" 
                             alt="Advertisement 1" 
                             class="img-fluid" 
                             style="max-height: 200px; object-fit: cover;"
                             onerror="this.onerror=null; this.src='{{ asset('assets/images/ad-1.jpeg') }}'; this.parentElement.querySelector('.text-success')?.classList.add('d-none'); this.parentElement.querySelector('.text-danger')?.classList.remove('d-none');">
                        @if($advertisement->hasAdvertisement1())
                            <small class="text-success d-block mt-2">Custom image uploaded</small>
                        @else
                            <small class="text-muted d-block mt-2">Using default image</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Current Advertisement 2</div>
                    <div class="card-body text-center">
                        <img src="{{ $advertisement->advertisement_2_url }}" 
                             alt="Advertisement 2" 
                             class="img-fluid" 
                             style="max-height: 200px; object-fit: cover;"
                             onerror="this.onerror=null; this.src='{{ asset('assets/images/ad-2.jpeg') }}'; this.parentElement.querySelector('.text-success')?.classList.add('d-none'); this.parentElement.querySelector('.text-danger')?.classList.remove('d-none');">
                        @if($advertisement->hasAdvertisement2())
                            <small class="text-success d-block mt-2">Custom image uploaded</small>
                        @else
                            <small class="text-muted d-block mt-2">Using default image</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Upload Form -->
        <form action="{{ route('admin.advertisement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Advertisement 1 (Top Banner)</label>
                <input type="file" name="advertisement_1" class="form-control">
                @error('advertisement_1')<small class="text-danger">{{ $message }}</small>@enderror
                <small class="form-text text-muted">Accepted formats: JPEG, PNG, JPG, WEBP. Max size: 2MB</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Advertisement 2 (Bottom Banner)</label>
                <input type="file" name="advertisement_2" class="form-control">
                @error('advertisement_2')<small class="text-danger">{{ $message }}</small>@enderror
                <small class="form-text text-muted">Accepted formats: JPEG, PNG, JPG, WEBP. Max size: 2MB</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Advertisements</button>
        </form>
    </div>
</x-layout.admin>
