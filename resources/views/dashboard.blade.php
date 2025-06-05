<x-layout.user>
    <style>
        .card {
            transition: transform 0.2s, box-shadow 0.2s; /* Smooth transition */
            margin-right: 15px; /* Add margin between cards */
            border-radius: 12px; /* Rounded corners for modern look */
            border: none; /* Remove default border */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); /* Subtle shadow by default */
            overflow: hidden; /* Ensure content stays within rounded corners */
            width: 250px; /* Set fixed width for consistency */
            background-color: white;
        }
    
        .card:hover {
            transform: translateY(-5px); /* Lift effect */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.16); /* Enhanced shadow on hover */
        }
        
        .card-body {
            padding: 1rem 1.25rem; /* Slightly adjust padding */
        }
    
        .profile-image {
            width: 65%; /* Reduced width for smaller profile image */
            height: auto; /* Maintain aspect ratio */
            margin: 10px auto; /* Center the image */
            display: block; /* Make it a block element for centering */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            object-fit: cover; /* Ensure image covers the area properly */
            max-height: 220px; /* Set maximum height to keep profiles consistent */
        }
    
        .no-profile-photo {
            width: 65%; /* Match the width of the profile image */
            height: 220px; /* Significantly reduced height for the placeholder */
            background-color: #f8f9fa; /* Light background color */
            display: flex;
            align-items: center; /* Vertically center the content */
            justify-content: center; /* Horizontally center the content */
            color: #6c757d; /* Muted text color */
            font-weight: bold;
            margin: 10px auto; /* Center the placeholder */
            border-radius: 8px; /* Rounded corners */
            text-align: center; /* Ensure text is centered inside the div */
            line-height: 1.5; /* Control the line height for better text visibility */
            border: 1px dashed #dee2e6; /* Dashed border for visual interest */
        }
    
        .view-profile {
            color: #007bff; /* Bootstrap primary color */
            text-decoration: none; /* Remove underline for cleaner look */
            cursor: pointer; /* Change cursor to pointer */
            font-weight: 500; /* Slightly bolder for emphasis */
            display: inline-block; /* Allow for padding */
            padding: 6px 16px; /* Add some padding */
            margin-top: 8px; /* Space from above content */
            border-radius: 20px; /* Rounded corners */
            border: 1px solid #007bff; /* Add border */
            transition: all 0.2s ease; /* Smooth transition */
        }
        
        .view-profile:hover {
            background-color: #007bff; /* Background color on hover */
            color: white; /* Text color on hover */
        }
    
        /* Wrapper for both profiles and the scroll buttons */
        .profile-wrapper {
            position: relative;
            width: 100%;
            padding: 0 40px; /* Add padding to make room for arrows */
            margin: 15px 0; /* Add some vertical spacing */
            box-sizing: border-box; /* Include padding in width calculation */
        }
    
        /* Scrollable container for profiles */
        .profile-scroll-container {
            display: flex;
            overflow-x: auto; /* Enable horizontal scrolling */
            padding: 20px 10px; /* Increased padding for better spacing */
            position: relative; /* Make the container relative to position arrows */
            -ms-overflow-style: none; /* Disable scrollbar for IE */
            scrollbar-width: none; /* Hide scrollbar for Firefox */
            gap: 15px; /* Add consistent gap between cards */
            scroll-snap-type: x mandatory; /* Enable scroll snapping */
        }
        
        /* Scroll snap alignment for cards */
        .profile-scroll-container .col-md-4 {
            scroll-snap-align: start; /* Enable scroll snapping */
            min-width: 250px; /* Match card width for consistency */
            margin-bottom: 0; /* Remove bottom margin */
        }
    
        /* Hide scrollbar for Webkit browsers (Chrome, Safari) */
        .profile-scroll-container::-webkit-scrollbar {
            display: none;
        }
    
        /* Styling for the left and right arrows */
        .scroll-arrow {
            position: absolute;  /* Absolute positioning within the wrapper */
            top: 50%;            /* Center vertically */
            transform: translateY(-50%); /* Adjust for perfect centering */
            background-color: rgba(255, 255, 255, 0.95);  /* More opaque background */
            color: #333;        /* Arrow color */
            border: none;
            font-size: 22px;     /* Slightly larger font size for better visibility */
            cursor: pointer;
            padding: 12px 14px;  /* Increased padding for larger click area */
            z-index: 100;        /* Higher z-index to ensure it's above profiles */
            border-radius: 50%;  /* Circular buttons */
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15); /* Subtle shadow */
            transition: all 0.2s ease; /* Smooth transition */
            width: 24px; /* Fixed width */
            height: 24px; /* Fixed height */
            display: flex; /* Use flexbox for centering */
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
            line-height: 1; /* Reset line height */
        }
        
        .scroll-arrow:hover {
            background-color: #fff; /* Solid background on hover */
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
            color: #007bff; /* Change color on hover to match theme */
        }
    
        .scroll-left {
            left: 5px;  /* Position left arrow more to the left */
        }
    
        .scroll-right {
            right: 5px; /* Position right arrow more to the right */
        }
    
        /* Responsive Styles for Mobile View */
        @media (max-width: 768px) {
            /* Adjust profile images and placeholders for mobile */
            .profile-image,
            .no-profile-photo {
                width: 85%; /* Still keep them slightly contained on mobile */
                max-height: 180px; /* Further reduce height on mobile */
            }
            
            /* Adjust card sizing for mobile */
            .card {
                margin-right: 5px;
                width: 220px; /* Slightly smaller on mobile */
            }
            
            /* Override inline styles for the About Us image */
            #weddingAbout img {
                width: 100% !important;
                height: auto !important;
            }
            
            /* Adjust heading size for better mobile display */
            .display-1 {
                font-size: 2.5rem;
            }
            
            /* Adjust profile wrapper padding for mobile */
            .profile-wrapper {
                padding: 0 35px; /* Slightly reduced padding on mobile */
            }
            
            /* Adjust scroll arrow positioning and size */
            .scroll-arrow {
                font-size: 16px;
                padding: 8px;
                width: 20px;
                height: 20px;
            }
            
            /* Improve card body padding on mobile */
            .card-body {
                padding: 0.75rem 1rem;
            }
            
            /* Adjust view profile button */
            .view-profile {
                padding: 4px 12px;
                font-size: 0.9rem;
            }
        }
        
        /* Add some styling for section headings */
        h2.text-center {
            margin: 2rem 0 1rem;
            font-weight: 600;
            color: #333;
            position: relative;
            padding-bottom: 10px;
        }
        
        h2.text-center:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(to right, #007bff, #6c757d);
            border-radius: 3px;
        }
        
        /* Improve card content styling */
        .card-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }
        
        .card-text {
            color: #6c757d;
            margin-bottom: 0.5rem;
            /* Limit bio text to 2 lines with ellipsis */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    
    

     
        {{-- about start --}}
        <div class="container-fluid position-relative " id="weddingAbout">


       



                
            <div class="container position-relative py-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row g-4 align-items-center">
                       
                            <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="mx-auto  mb-3 wow fadeInUp" data-wow-delay="0.1s" >
                                    <h2 class="display-1 mb-0" style="color: #60B5FF;">About Us</h2>
                                </div>
                                <div class="d-flex">
                                    <div class="my-auto">
                                       <p class="text-justify">Welcome to Aditya Matrimony !!!

                                        Aditya Matrimony is a community-driven organization dedicated to facilitating successful matrimonial alliances within the  community. Established with the vision to preserve cultural heritage and strengthen bonds, we aim to provide a reliable and respectful platform for individuals and families looking for compatible life partners.
                                       </p>
                                      
                                        </div>
                                </div>
                                <style>
.know-more-btn {
  min-width: 150px;
  padding-top: 12px;
  padding-bottom: 12px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transform: translateY(0);
  transition: all 0.2s ease;
  background: #60B5FF !important;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
}

.know-more-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 7px 14px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
  background: #4da0e6 !important;
}

.know-more-btn:active {
  transform: translateY(1px);
  box-shadow: 0 3px 4px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.08);
}
</style>
<div class="text-start"><a class="btn btn-primary btn-primary-outline-0 mt-3 know-more-btn" href="/about"><span style="position: relative; top: -1px;">Know More</span></a></div>
                            </div>
                            <div class="col-lg-5 wow fadeInUp order-first order-md-last" data-wow-delay="0.3s">
                                <img src="{{ asset('assets/images/aboutbanner.jpg') }}" 
                                alt="Aditya Matrimony" 
                                style="width: 400px; height: 400px; object-fit: cover;">
                                                        </div>
                           
                           
                        </div>
                    </div>
                </div>
            </div>
         
        {{-- about end --}}
        @if(session('error'))
        <div class="alert mt-2 alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong> {{ session('error') }}
        </div>
        @endif
        <div>
        <h2 class="text-center">Bride Profiles</h2>
        <div class="profile-wrapper">
            <!-- Left Arrow -->
            <button class="scroll-arrow scroll-left" onclick="scrollContainer('bride-profiles', -1)">❮</button>
            <div class="profile-scroll-container" id="bride-profiles">
                @foreach($users as $user)
                    @if ($user->role == 'bride')
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if ($user->img_1)
                                    <div x-data="imageLoader()" x-init="fetchImage('{{ $user->img_1 }}')">
                                        <template x-if="imageUrl">
                                            <img class="profile-image" :src="imageUrl" alt="Bride Profile Image" />
                                        </template>
                                        <template x-if="!imageUrl">
                                            <div class="no-profile-photo">Loading Image...</div>
                                        </template>
                                    </div>
                                @elseif ($user->img_2)
                                    <div x-data="imageLoader()" x-init="fetchImage('{{ $user->img_2 }}')">
                                        <template x-if="imageUrl">
                                            <img class="profile-image" :src="imageUrl" alt="Bride Profile Image" />
                                        </template>
                                        <template x-if="!imageUrl">
                                            <div class="no-profile-photo">Loading Image...</div>
                                        </template>
                                    </div>
                                @elseif ($user->img_3)
                                    <div x-data="imageLoader()" x-init="fetchImage('{{ $user->img_3 }}')">
                                        <template x-if="imageUrl">
                                            <img class="profile-image" :src="imageUrl" alt="Bride Profile Image" />
                                        </template>
                                        <template x-if="!imageUrl">
                                            <div class="no-profile-photo">Loading Image...</div>
                                        </template>
                                    </div>
                                @else
                                    <div class="no-profile-photo">No Profile Photo Displayed</div>
                                @endif
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $user->first_name }} </h5>
                                    <p class="card-text">{{ \Carbon\Carbon::parse($user->date_of_birth)->age }} years</p>
                                     <p class="card-text">{{ $user->bio }}</p>
                                    <span class="view-profile" onclick="location.href='{{ route('user.show_profile', $user->id) }}'">View Profile</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- Right Arrow -->
            <button class="scroll-arrow scroll-right" onclick="scrollContainer('bride-profiles', 1)">❯</button>
        </div>

        <h2 class="text-center">Groom Profiles</h2>
        <div class="profile-wrapper">
            <!-- Left Arrow -->
            <button class="scroll-arrow scroll-left" onclick="scrollContainer('groom-profiles', -1)">❮</button>
            <div class="profile-scroll-container" id="groom-profiles">
                @foreach($users as $user)
                    @if ($user->role == 'groom')
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if ($user->img_1)
                                    <div x-data="imageLoader()" x-init="fetchImage('{{ $user->img_1 }}')">
                                        <template x-if="imageUrl">
                                            <img class="profile-image" :src="imageUrl" alt="Groom Profile Image" />
                                        </template>
                                        <template x-if="!imageUrl">
                                            <div class="no-profile-photo">Loading Image...</div>
                                        </template>
                                    </div>
                                @elseif ($user->img_2)
                                    <div x-data="imageLoader()" x-init="fetchImage('{{ $user->img_2 }}')">
                                        <template x-if="imageUrl">
                                            <img class="profile-image" :src="imageUrl" alt="Groom Profile Image" />
                                        </template>
                                        <template x-if="!imageUrl">
                                            <div class="no-profile-photo">Loading Image...</div>
                                        </template>
                                    </div>
                                @elseif ($user->img_3)
                                    <div x-data="imageLoader()" x-init="fetchImage('{{ $user->img_3 }}')">
                                        <template x-if="imageUrl">
                                            <img class="profile-image" :src="imageUrl" alt="Groom Profile Image" />
                                        </template>
                                        <template x-if="!imageUrl">
                                            <div class="no-profile-photo">Loading Image...</div>
                                        </template>
                                    </div>
                                @else
                                    <div class="no-profile-photo">No Profile Photo Displayed</div>
                                @endif
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $user->first_name }} </h5>
                                    <p class="card-text">{{ \Carbon\Carbon::parse($user->date_of_birth)->age }} years</p>
                                     <p class="card-text">{{ $user->bio }}</p>
                                    <span class="view-profile" onclick="location.href='{{ route('user.show_profile', $user->id) }}'">View Profile</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- Right Arrow -->
            <button class="scroll-arrow scroll-right" onclick="scrollContainer('groom-profiles', 1)">❯</button>
        </div>
    </div>
    </div>

    <script>
        // Function to handle the scrolling behavior
        function scrollContainer(containerId, direction) {
            const container = document.getElementById(containerId);
            const scrollAmount = 300; // Amount to scroll (adjust as needed)

            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
            
            // Update arrow visibility after scrolling
            setTimeout(() => {
                checkArrowVisibility(containerId);
            }, 400); // Wait for scroll animation to complete
        }

        // Function to check if arrows should be visible
        function checkArrowVisibility(containerId) {
            const container = document.getElementById(containerId);
            const leftArrow = container.parentNode.querySelector('.scroll-arrow.scroll-left');
            const rightArrow = container.parentNode.querySelector('.scroll-arrow.scroll-right');
            
            // Hide left arrow if at the beginning
            if (container.scrollLeft <= 10) {
                leftArrow.style.display = 'none';
            } else {
                leftArrow.style.display = 'flex';
            }
            
            // Hide right arrow if at the end
            if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                rightArrow.style.display = 'none';
            } else {
                rightArrow.style.display = 'flex';
            }
        }

        // Check arrow visibility on page load for all containers
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize arrows for bride profiles
            checkArrowVisibility('bride-profiles');
            
            // Initialize arrows for groom profiles
            checkArrowVisibility('groom-profiles');
            
            // Add scroll event listeners to update arrows during manual scrolling
            document.getElementById('bride-profiles').addEventListener('scroll', function() {
                checkArrowVisibility('bride-profiles');
            });
            
            document.getElementById('groom-profiles').addEventListener('scroll', function() {
                checkArrowVisibility('groom-profiles');
            });
        });

        // Image Loader (Your original code)
        function imageLoader() {
            return {
                imageUrl: null,

                async fetchImage(filename) {
                    try {
                        const response = await fetch(`/api/images/${filename}`);
                        if (!response.ok) throw new Error('Image not found');
                        
                        // Create a blob URL for the image
                        const blob = await response.blob();
                        this.imageUrl = URL.createObjectURL(blob);
                    } catch (error) {
                        console.error('Error fetching image:', error);
                        this.imageUrl = null; // Handle error case
                    }
                }
            };
        }
    </script>
</x-layout.user>
