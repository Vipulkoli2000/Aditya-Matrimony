<x-layout.admin>
    <style>
        .user-info-card, .packages-card, .add-package-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1rem;
        }

        .package-item {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #f8f9fa;
        }

        .package-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .package-name {
            font-weight: 600;
            font-size: 1.1em;
            color: #495057;
        }

        .package-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .detail-item {
            font-size: 0.9em;
            color: #6c757d;
        }

        .detail-label {
            font-weight: 600;
            color: #495057;
        }

        .badge {
            padding: 0.25em 0.5em;
            border-radius: 0.25rem;
            font-size: 0.875em;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: black;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-info {
            background-color: #17a2b8;
            color: white;
        }

        .badge-primary {
            background-color: #007bff;
            color: white;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            font-size: 1rem;
        }

        .btn {
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 0.875rem;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .no-packages {
            color: #6c757d;
            font-style: italic;
            text-align: center;
            padding: 2rem;
        }

        .back-btn {
            margin-bottom: 1rem;
        }

        .user-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .token-summary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            text-align: center;
        }

        .token-number {
            font-size: 2em;
            font-weight: bold;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Back Button -->
                <a href="{{ route('profile_packages.index') }}" class="btn btn-secondary back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Profile Packages
                </a>

                <!-- User Information Card -->
                <div class="user-info-card">
                    <div class="card-header">
                        <h4 class="mb-0">User Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="user-details">
                            <div>
                                <p><span class="detail-label">Name:</span> {{ $user->name }}</p>
                                <p><span class="detail-label">Email:</span> {{ $user->email }}</p>
                                @if($user->profile)
                                    <p><span class="detail-label">Profile Type:</span>
                                        @if(strtolower($user->profile->gender) === 'male')
                                            <span class="badge badge-primary">Groom</span>
                                        @elseif(strtolower($user->profile->gender) === 'female')
                                            <span class="badge badge-success">Bride</span>
                                        @else
                                            <span class="badge badge-secondary">{{ ucfirst($user->profile->gender) }}</span>
                                        @endif
                                    </p>
                                @endif
                            </div>
                            <div class="token-summary">
                                <div class="token-number">{{ $user->profile->available_tokens ?? 0 }}</div>
                                <div>Available Tokens</div>
                            </div>
                        </div>
                        
                        <!-- Add Package Section -->
                        <hr style="margin: 1.5rem 0;">
                        <h5 class="detail-label mb-3">Add New Package</h5>
                        @if($user->profile)
                        <form action="{{ route('profile_packages.add_to_user') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="package_id" class="detail-label">Select Package:</label>
                                        <select name="package_id" id="package_id" class="form-control" required>
                                            <option value="">Choose a package...</option>
                                            @foreach($availablePackages as $availablePackage)
                                                <option value="{{ $availablePackage->id }}">
                                                    {{ $availablePackage->name }} - ₹{{ number_format($availablePackage->price, 2) }}
                                                    ({{ $availablePackage->tokens }} tokens, {{ $availablePackage->validity }} days)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="visibility: hidden;">Action</label>
                                        <button type="submit" class="btn btn-success" style="width: 100%; display: block;">
                                            Add Package
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
                            <p class="no-packages">User has no profile. Cannot add packages.</p>
                        @endif
                    </div>
                </div>

                <!-- Current Packages -->
                <div class="packages-card">
                    <div class="card-header">
                        <h4 class="mb-0">Current Packages</h4>
                    </div>
                    <div class="card-body">
                        @if($user->profile && $user->profile->profilePackages->count() > 0)
                            <div class="row">
                                @foreach($user->profile->profilePackages as $package)
                                <div class="col-md-6 col-lg-4">
                                    <div class="package-item">
                                        <div class="package-header">
                                            <div class="package-name">{{ $package->name }}</div>
                                            @php
                                                $expiryDate = \Carbon\Carbon::parse($package->pivot->expires_at);
                                                $now = \Carbon\Carbon::now();
                                            @endphp
                                            @if($expiryDate->isFuture())
                                                <span class="badge badge-success">Active</span>
                                            @elseif($expiryDate->diffInDays($now) <= 7 && $expiryDate->isFuture())
                                                <span class="badge badge-warning">Expiring Soon</span>
                                            @else
                                                <span class="badge badge-danger">Expired</span>
                                            @endif
                                        </div>
                                        
                                        <div class="package-details" style="display: block;">
                                            <div class="detail-item" style="margin-bottom: 0.25rem;">
                                                <span class="detail-label">Price:</span> ₹{{ number_format($package->price, 2) }}
                                            </div>
                                            <div class="detail-item" style="margin-bottom: 0.25rem;">
                                                <span class="detail-label">Tokens:</span> 
                                                {{ $package->pivot->tokens_received - $package->pivot->tokens_used }}/{{ $package->pivot->tokens_received }}
                                            </div>
                                            <div class="detail-item" style="margin-bottom: 0.25rem;">
                                                <span class="detail-label">Start Date:</span> 
                                                {{ \Carbon\Carbon::parse($package->pivot->starts_at)->format('d-m-Y') }}
                                            </div>
                                            <div class="detail-item" style="margin-bottom: 0.25rem;">
                                                <span class="detail-label">Expiry Date:</span> 
                                                {{ \Carbon\Carbon::parse($package->pivot->expires_at)->format('d-m-Y') }}
                                            </div>
                                            <div class="detail-item" style="margin-bottom: 0.25rem;">
                                                <span class="detail-label">Validity:</span> {{ $package->validity }} days
                                            </div>
                                            @if($package->description)
                                            <div class="detail-item">
                                                <span class="detail-label">Description:</span> {{ $package->description }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="no-packages">
                                No packages purchased yet
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
