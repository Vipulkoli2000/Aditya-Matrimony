<x-layout.user_banner>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Personal Information Panel</title>
        <style>
            /* Card styling for 3D effect */
            .card {
                border: 1px solid #ddd;
                border-radius: 8px;
                transition: transform 0.2s, box-shadow 0.2s;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            }
            .card:hover {
                transform: translateY(-10px);
                box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            }
            .card-body {
                text-align: center; /* Center align text inside the card */
            }
            .view-profile {
                color: blue;
                font-weight: bold;
                cursor: pointer;
                display: inline-block;
            }
            /* Sidebar styles */
            .sidebar {
                width: 300px;
                position: sticky;
                top: 0;
                height: 100vh;
                background-color: #f5f5f5;
                padding: 15px;
                border-left: 1px solid #ddd;
            }
            /* Image styles */
            .profile-image {
                width: 80%;
                height: auto;
                margin: 10px auto;
                display: block;
                border-radius: 8px;
            }
            .no-profile-photo {
                width: 80%;
                height: 150px;
                background-color: #f0f0f0;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #888;
                font-weight: bold;
                margin: 10px auto;
                border-radius: 8px;
            }
            button.btn {
                background-color: #ff0000; /* Rose Red color */
                color: white !important;
                border: none;
            }
            /* Flex container wrapping main content and sidebar */
            .content-wrapper {
                display: flex;
                flex-direction: row;
                align-items: flex-start;
            }
            /* Center the main content column with a max width */
            .main-content {
                flex: 1;
                max-width: 900px; /* Adjust width as needed */
                margin: 0 auto;
            }
            
            /* Mobile responsive styles */
            @media (max-width: 768px) {
                .content-wrapper {
                    flex-direction: column;
                }
                .sidebar {
                    width: 100%;
                    height: auto;
                    position: relative;
                    border-left: none;
                    border-top: 1px solid #ddd;
                }
                .main-content {
                    width: 100%;
                    max-width: 100%;
                    margin: 0 auto;
                    padding: 0 15px;
                }
                .row.justify-content-center {
                    margin: 0 auto;
                    width: 100%;
                    display: flex;
                    justify-content: center;
                }
                .col-auto {
                    width: 100%;
                    display: flex;
                    justify-content: center;
                }
                .card {
                    width: 100% !important;
                    max-width: 300px;
                    margin: 10px auto;
                }
            }
        </style>
    </head>
    <body>
        <div class="content-wrapper">
            <div class="main-content">
                <div class="container-fluid">
                    @if(session('error'))
                        <div class="alert mt-2 alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error</strong> {{ session('error') }}
                        </div>
                    @endif
                    <h2 class="text-center">Favorites</h2>
                    <div class="panel">
                        <!-- Use "justify-content-center" and "col-auto" to center the cards -->
                        <div class="row g-3 justify-content-center">
                            @foreach($users as $user)
                                <div class="col-auto">
                                    <div class="card my-2" style="width: 18rem;">
                                        @if ($user->img_1)
                                            <div x-data="imageLoader()" x-init="fetchImage('{{ $user->img_1 }}')">
                                                <template x-if="imageUrl">
                                                    <!-- Wrap the image in an anchor tag to open it in a new tab -->
                                                    <a :href="imageUrl" target="_blank">
                                                        <img class="profile-image" style="max-width: 100px;" :src="imageUrl" alt="Uploaded Image" />
                                                    </a>
                                                </template>
                                                <template x-if="!imageUrl">
                                                    <div class="no-profile-photo">No Profile Photo Displayed</div>
                                                </template>
                                            </div>
                                        @else
                                            <div class="no-profile-photo">No Profile Photo Displayed</div>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h5>
                                            <p class="card-text">{{ \Carbon\Carbon::parse($user->date_of_birth)->age }} years</p>
                                            <p class="card-text">{{ $user->bio }}</p>
                                            <a href="{{ route('user.show_profile', $user->id) }}" class="view-profile">View Profile</a>
                                            <form action="{{ route('profiles.remove_favorite') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="favorite_id" value="{{ $user->id }}">
                                                <input type="hidden" name="fav_page" value="fav_page">
                                                <button class="btn text-white btn-primary" type="submit">Remove from Favorites</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar">
                <x-common.usersidebar />
            </div>
        </div>
    </body>
    </html>

    <!-- Image display script -->
    <script>
        function imageLoader() {
            return {
                imageUrl: null,
                async fetchImage(filename) {
                    try {
                        const response = await fetch(`/api/images/${filename}`);
                        if (!response.ok) throw new Error('Image not found');
                        const blob = await response.blob();
                        this.imageUrl = URL.createObjectURL(blob);
                    } catch (error) {
                        console.error('Error fetching image:', error);
                        this.imageUrl = null;
                    }
                }
            };
        }
    </script>

</x-layout.user_banner>
