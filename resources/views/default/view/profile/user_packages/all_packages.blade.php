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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchased_packages as $purchased_package)
                        <tr>
                            <td>{{ $purchased_package->name }}</td>
                            <td>{{ $purchased_package->description }}</td>
                            <td>₹{{ number_format($purchased_package->price, 2) }}</td>
                            <td>{{ $purchased_package->pivot->expires_at }}</td>
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

<!-- Razorpay integration script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.razorpay-buy-btn').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            var packageId = this.dataset.id;
            var packageName = this.dataset.name;
            var packagePrice = this.dataset.price;
            var options = {
                "key": "{{ config('services.razorpay.key') }}",
                "amount": (parseFloat(packagePrice) * 100).toFixed(0),
                "name": packageName,
                "description": "Purchase " + packageName,
                "handler": function (response){
                    // Show loading message
                    const buyBtn = document.querySelector(`[data-id="${packageId}"]`);
                    const originalText = buyBtn.innerHTML;
                    buyBtn.disabled = true;
                    buyBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
                    
                    fetch("{{ route('razorpay.payment') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            razorpay_payment_id: response.razorpay_payment_id,
                            package_id: packageId
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        if(res.success) {
                            // Create success alert
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'alert alert-success alert-dismissible fade show';
                            alertDiv.role = 'alert';
                            alertDiv.innerHTML = `
                                <strong>Success!</strong> ${packageName} purchased successfully.
                                <p>Tokens received: ${res.package?.tokens || ''}</p>
                                <p>Expires on: ${res.package?.expires_at || ''}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            `;
                            
                            // Insert alert at the top of the main content
                            const mainContent = document.querySelector('.main-content');
                            mainContent.insertBefore(alertDiv, mainContent.firstChild);
                            
                            // Reload the page after a delay to allow the user to see the message
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000);
                        } else {
                            buyBtn.disabled = false;
                            buyBtn.innerHTML = originalText;
                            alert('Payment failed: ' + (res.message || 'Unknown error'));
                        }
                    })
                    .catch(err => {
                        console.error('Error processing payment:', err);
                        buyBtn.disabled = false;
                        buyBtn.innerHTML = originalText;
                        alert('Payment processing error. Please try again.');
                    });
                },
                "prefill": {
                    "name": "{{ auth()->user()->name ?? '' }}",
                    "email": "{{ auth()->user()->email ?? '' }}"
                },
                "theme": {
                    "color": "#0F408F"
                },
                "modal": {
                    "ondismiss": function() {
                        console.log('Payment modal dismissed');
                    }
                }
            };
            
            options.handler = options.handler.bind(this);
            
            // Initialize Razorpay
            var rzp = new Razorpay(options);
            rzp.open();
            
            // Handle payment failures
            rzp.on('payment.failed', function (response) {
                console.error('Payment failed:', response.error);
                alert('Payment failed: ' + response.error.description);
            });
        });
    });
});
</script>
