<x-layout.user_banner>
    <style>
        /* Sidebar and content wrapper styles */
        .content-wrapper {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
        }
        
        #sidebar {
            position: sticky;
            top: 0;
            width: 220px;
            background-color: #f8f9fa;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1030;
            overflow-y: auto;
            display: block;
        }

        @media (max-width: 992px) {
            #sidebar {
                display: none;
            }
            #sidebarToggle {
                display: block;
            }
            .content-wrapper {
                flex-direction: column;
            }
        }

        @media (min-width: 992px) {
            #sidebar {
                display: block;
            }
        }

        .main-content {
            flex: 1;
            padding: 20px;
            color: #000; /* Make text black */
        }

        /* Table styles */
        .container.pl-4 {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center the container contents */
            width: 100%;
        }

        .packages-table {
            width: 90%; /* Slightly reduce width to look better centered */
            margin: 0 auto; /* Center the table */
            color: #000;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .packages-table thead {
            position: sticky;
            top: 0;
            background-color: #fff;
            z-index: 1;
        }

        .packages-table tbody {
            display: block;
            max-height: 400px; 
            overflow-y: auto;
        }

        .packages-table thead tr,
        .packages-table tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .packages-table th,
        .packages-table td {
            padding: 0.5rem; /* Reduced from 1rem to 0.5rem */
            text-align: left;
            border-bottom: 1px solid #dee2e6;
            color: #000;
            line-height: 1.2; /* Added line height for compact rows */
        }

        .packages-table tr {
            height: 60px; /* Set fixed height for each row */
        }

        .mb-3 {
            width: 90%; /* Match table width */
        }
        
        /* New style for back button */
        .back-btn {
            font-size: 0.875rem; /* Make text smaller */
            padding: 0.25rem 0.5rem; /* Reduce padding */
        }
        /* Expired row coloring */
        .expired-row td, .expired-row th {
            color: #dc3545;
        }
    </style>

    <div class="content-wrapper">
        <div class="panel main-content">
            <h3 class="text-center m-3">All Purchased Packages</h3>
            
            <div class="container pl-4">
                <div class="mb-3">
                    <a href="{{ route('user_packages.create') }}" class="btn btn-secondary back-btn">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                
                <table class="packages-table">
                    <thead>
                        <tr>
                            <th>Package Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchased_packages as $purchased_package)
                        @php $isExpired = \Carbon\Carbon::parse($purchased_package->pivot->expires_at)->isPast(); @endphp
                        <tr class="{{ $isExpired ? 'expired-row' : ''}}">
                            <td>{{ $purchased_package->name }}</td>
                            <td>{{ $purchased_package->description }}</td>
                            <td>₹{{ number_format($purchased_package->price, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($purchased_package->pivot->expires_at)->format('d-m-Y') }}</td>
                            <td>
                                @if($isExpired)
                                    <span class="badge bg-secondary">Expired</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('generate.invoice', $purchased_package->id) }}" class="btn btn-secondary btn-sm" target="_blank">
                                    Download Invoice
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
     
    </div>
</x-layout.user_banner>

