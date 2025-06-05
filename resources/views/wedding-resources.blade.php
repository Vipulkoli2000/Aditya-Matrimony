<x-layout.user_banner>
  <!-- Mobile Responsive CSS -->
  <style>
    @media (max-width: 767px) {
      /* Adjust heading and text margins and font sizes */
      #weddingResources h2.display-1.text-primary {
        margin-left: 15px !important;
        margin-top: 15px !important;
        font-size: 2.5rem !important;
      }
      #weddingResources h1 {
        font-size: 1.5rem !important;
        margin-left: 15px !important;
      }
      
      /* Make listing cards full width on mobile */
      .listing-card {
        width: 100% !important;
        margin-bottom: 20px !important;
      }
      
      /* Adjust card content padding */
      .card-body {
        padding: 15px !important;
      }
      
      /* Filter section responsive */
      .filter-section {
        padding: 15px !important;
        margin: 0 10px !important;
      }
      
      .filter-section .col-sm-6 {
        margin-bottom: 10px;
      }
    }
    
    /* Card styling */
    .listing-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
      height: 100%;
    }
    
    .listing-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    
    .listing-img-container {
      height: 150px;
      overflow: hidden;
    }
    
    .listing-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    
    .listing-card:hover .listing-img {
      transform: scale(1.05);
    }
    
    .card-body {
      padding: 20px;
    }
    
    .business-name {
      font-weight: 700;
      color: #333;
      margin-bottom: 10px;
      font-size: 1.2rem;
    }
    
    .listing-info {
      margin-bottom: 5px;
      color: #666;
    }
    
    .listing-info i {
      width: 20px;
      text-align: center;
      margin-right: 8px;
      color: #60B5FF;
    }
    
    .btn-contact {
      background: linear-gradient(to bottom, #60B5FF, #007BFF);
      border: none;
      border-radius: 50px;
      padding: 8px 20px;
      color: white;
      font-weight: 500;
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .btn-contact:hover {
      background: linear-gradient(to bottom, #70C6FF, #005FFF);
      transform: translateY(-2px);
      box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }
    
    .empty-state {
      text-align: center;
      padding: 40px;
      background-color: #f8f9fa;
      border-radius: 10px;
      margin: 20px 0;
    }
    
    .empty-state i {
      font-size: 50px;
      color: #60B5FF;
      margin-bottom: 20px;
    }
  </style>

  <div>
    <div class="" id="weddingResources">
      <div class="container position-relative py-5">
        <div class="row">
          <div class="col-lg-12">
            <div class="mx-auto mb-3 wow fadeInUp" data-wow-delay="0.1s">
              <h2 class="display-1" style="margin-left: 35px; margin-top: 35px; color: #60B5FF;">Wedding Resources</h2>
            </div>
            <div class="mb-4">
              <p style="color: black; margin-left: 30px;">
                Discover our curated collection of wedding service providers to help make your special day perfect. From venues to photographers, find everything you need for your wedding planning journey.
              </p>
            </div>
            
            <!-- Filter Section -->
            <div class="filter-section mb-4" style="background: linear-gradient(to right, #f8f9fa, #ffffff); border-radius: 10px; padding: 20px; margin: 0 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border: 1px solid rgba(242, 114, 114, 0.1);">
              <style>
                /* Form field styling */
                .form-select, .form-control {
                  padding: 10px 15px;
                  border-radius: 8px;
                  border: 1px solid rgba(0, 0, 0, 0.1);
                  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
                  transition: all 0.3s ease;
                  font-size: 0.9rem;
                  background-color: #ffffff;
                  color: #333;
                  appearance: none;
                  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2360B5FF' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
                  background-repeat: no-repeat;
                  background-position: right 10px center;
                  background-size: 12px;
                  padding-right: 30px;
                }
                
                .form-select:focus, .form-control:focus {
                  border-color: #60B5FF;
                  box-shadow: 0 3px 8px rgba(96, 181, 255, 0.15);
                  outline: none;
                  transform: translateY(-2px);
                  transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
                }
                
                .form-label {
                  font-size: 0.85rem;
                  margin-bottom: 6px;
                  font-weight: 600 !important;
                  color: #555 !important;
                  letter-spacing: 0.3px;
                  position: relative;
                  padding-left: 12px;
                }
                
                .form-label:before {
                  content: '';
                  position: absolute;
                  left: 0;
                  top: 50%;
                  transform: translateY(-50%);
                  width: 4px;
                  height: 4px;
                  border-radius: 50%;
                  background-color: #60B5FF;
                  margin-right: 8px;
                }
                
                .form-select option {
                  padding: 10px;
                }
                
                /* Reset button styling */
                .btn-reset-filter {
                  background: linear-gradient(to bottom, #6c757d, #495057);
                  border: none;
                  border-radius: 6px;
                  padding: 8px 16px;
                  color: white;
                  font-weight: 500;
                  transition: all 0.3s ease;
                  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }
                
                .btn-reset-filter:hover {
                  background: linear-gradient(to bottom, #5a6268, #343a40);
                  transform: translateY(-2px);
                  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
                }
              </style>
              <h5 class="mb-4" style="color: #60B5FF; font-weight: 600; letter-spacing: 0.5px;"><i class="fas fa-filter me-2"></i>Filter Wedding Resources</h5>
              <form action="{{ route('wedding.resources') }}" method="GET" id="filter-form">
                <div class="row g-3">
                  <div class="col-md-3 col-sm-6">
                    <label for="country" class="form-label small">Country</label>
                    <select class="form-select" id="country" name="country" onchange="document.getElementById('filter-form').submit();">
                      <option value="">All Countries</option>
                      @foreach($countries as $key => $value)
                        <option value="{{ $value }}" {{ request('country') == $value ? 'selected' : '' }}>{{ $value }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <label for="state" class="form-label small">State</label>
                    <select class="form-select" id="state" name="state" onchange="document.getElementById('filter-form').submit();">
                      <option value="">All States</option>
                      @foreach($states as $key => $value)
                        <option value="{{ $value }}" {{ request('state') == $value ? 'selected' : '' }}>{{ $value }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <label for="city" class="form-label small">City</label>
                    <select class="form-select" id="city" name="city" onchange="document.getElementById('filter-form').submit();">
                      <option value="">All Cities</option>
                      @foreach($cities as $city)
                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <label for="listing_category_id" class="form-label small">Category</label>
                    <select class="form-select" id="listing_category_id" name="listing_category_id" onchange="document.getElementById('filter-form').submit();">
                      <option value="all">All Categories</option>
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('listing_category_id') == $category->id ? 'selected' : '' }}>{{ $category->listing_category }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-12 d-flex justify-content-end mt-3">
                    <button type="reset" class="btn-reset-filter" onclick="window.location.href = '{{ route('wedding.resources') }}'">
                      <i class="fas fa-undo me-1"></i> Reset Filters
                    </button>
                  </div>
                </div>
              </form>
            </div>
            
            <!-- Listings Section -->
            <div class="row mt-3">
              @if(count($listings) > 0)
                @foreach($listings as $listing)
                  <div class="col-lg-3 col-md-6 mb-4">
                    <div class="listing-card">
                      <div class="listing-img-container">
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
                          
                          @if($imageData)
                            <img src="{{ $src }}" class="listing-img" alt="{{ $listing->business_name }}">
                          @else
                            <img src="{{ asset('assets/images/listing-placeholder.jpg') }}" class="listing-img" alt="{{ $listing->business_name }}">
                          @endif
                        @else
                          <img src="{{ asset('assets/images/listing-placeholder.jpg') }}" class="listing-img" alt="{{ $listing->business_name }}">
                        @endif
                      </div>
                      <div class="card-body">
                        <h5 class="business-name">{{ $listing->business_name }}</h5>
                        <p class="text-muted mb-3">{{ $listing->category->listing_category ?? 'General' }}</p>
                        
                        <div class="listing-info">
                          <i class="fas fa-user"></i> {{ $listing->contact_person }}
                        </div>
                        <div class="listing-info">
                          <i class="fas fa-phone-alt"></i> {{ $listing->mobile }}
                        </div>
                        <div class="listing-info">
                          <i class="fas fa-envelope"></i> {{ $listing->email }}
                        </div>
                        <div class="listing-info mb-3">
                          <i class="fas fa-map-marker-alt"></i> {{ $listing->city }}, {{ $listing->state }}
                        </div>
                        
                        <div class="mt-4 d-flex justify-content-between align-items-center">
                          <button type="button" class="btn btn-contact" data-bs-toggle="modal" data-bs-target="#listingModal{{ $listing->id }}">
                            <i class="fas fa-info-circle me-1"></i> Details
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Modal for each listing -->
                  <div class="modal fade" id="listingModal{{ $listing->id }}" tabindex="-1" aria-labelledby="listingModalLabel{{ $listing->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(to right, #60B5FF, #007BFF); color: white;">
                          <h5 class="modal-title" id="listingModalLabel{{ $listing->id }}">{{ $listing->business_name }}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-5 mb-3 mb-md-0">
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
                                
                                @if($imageData)
                                  <img src="{{ $src }}" class="img-fluid rounded" alt="{{ $listing->business_name }}">
                                @else
                                  <img src="{{ asset('assets/images/listing-placeholder.jpg') }}" class="img-fluid rounded" alt="{{ $listing->business_name }}">
                                @endif
                              @else
                                <img src="{{ asset('assets/images/listing-placeholder.jpg') }}" class="img-fluid rounded" alt="{{ $listing->business_name }}">
                              @endif
                            </div>
                            <div class="col-md-7">
                              <h6 class="fw-bold">{{ $listing->category->listing_category ?? 'General' }}</h6>
                              <p class="text-muted mb-3"><i class="fas fa-map-marker-alt me-2"></i>{{ $listing->address }}, {{ $listing->city }}, {{ $listing->state }}, {{ $listing->country }}</p>
                              
                              <div class="mb-3">
                                <h6 class="fw-bold">Contact Information:</h6>
                                <p><i class="fas fa-user me-2"></i>{{ $listing->contact_person }}</p>
                                <p><i class="fas fa-phone-alt me-2"></i>{{ $listing->mobile }}</p>
                                <p><i class="fas fa-envelope me-2"></i>{{ $listing->email }}</p>
                              </div>
                            </div>
                          </div>
                          
                          <div class="mt-4">
                            <h6 class="fw-bold">Description:</h6>
                            <p>{{ $listing->description }}</p>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="col-12">
                  <div class="empty-state">
                    <i class="fas fa-search"></i>
                    <h4>No wedding resources found</h4>
                    <p>We're currently updating our list of wedding service providers. Please check back soon!</p>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout.user_banner>
