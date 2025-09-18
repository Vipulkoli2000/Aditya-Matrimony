<x-layout.user_banner>
    <style>
        /* Main content area takes full width */
        .main-content {
            width: 100%;
            max-width: 1200px; /* Increased width for better use of space */
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Package box as card styling */
        .package-box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Card-like shadow */
            padding: 20px;
            text-align: center;
            transition: box-shadow 0.3s;
            min-width: 200px;
            max-width: 300px; /* Restrict maximum width */
            overflow: hidden; /* Prevent overflow */
            white-space: normal; /* Allow text to wrap */
        }

        .package-box:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .carousel-wrapper {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .carousel-content {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 10px;
            max-width: 100%;
            white-space: nowrap;
        }

        /* Carousel controls */
        .carousel-controls {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .carousel-button {
            background-color: transparent;
            color: #333; /* Dark color for visibility */
            border: none;
            padding: 8px 12px;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.3s;
            font-size: 1.5rem; /* Increase font size for better visibility */
        }

        .carousel-button:hover {
            opacity: 1;
        }

        /* Text styling within cards */
        .package-box h4 {
            margin-bottom: 15px;
            font-size: 1.25rem;
            color: #333;
        }

        .package-box p {
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #555;
        }

        .package-box .btn-primary {
            margin-top: 10px;
        }
        
        /* Add table styles */
        .packages-table-container {
            position: relative;
            width: 85%;
            margin: 0 auto;
        }
        
        .packages-table {
            width: 100%;
            margin-bottom: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            color: #000;
        }
        
        .packages-table th,
        .packages-table td {
            padding: 0.5rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
            color: #000;
            line-height: 1.2;
        }

        .view-all-link {
            position: absolute;
            bottom: -30px;
            right: 0;
            font-size: 0.875rem;
        }
        
        @media (max-width: 768px) {
            .packages-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }

        
        /* Media queries for mobile responsiveness */
        @media (max-width: 768px) {
            .main-content {
                max-width: 100%;
                margin: 0;
                padding: 0 10px;
            }
            .package-box {
                width: 100%;
                margin: 10px 0;
            }
            .packages-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>

    <div class="main-content">
        <h3 class="text-center m-3">Available Tokens: {{$user->available_tokens}}</h3>

        @if($purchased_packages->isNotEmpty())
        <h3 class="text-center m-3">Purchased Packages</h3>
        <div class="container pl-4">
            <div class="packages-table-container">
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
                        @foreach ($purchased_packages->take(3) as $purchased_package)
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
                @if($purchased_packages->count() > 3)
                    <div class="view-all-link">
                        <a href="{{ route('all.purchased.packages') }}" class="btn btn-sm btn-link">View All Purchased Packages →</a>
                    </div>
                @endif
            </div>
        </div>
        @endif

        <div class="container">
            <h3 class="text-center m-3">Packages</h3>
            <div class="carousel-wrapper">
                <div class="carousel-content" id="availablePackagesCarousel">
                    @foreach ($packages as $package)
                        @php
                            $displayPrice = (auth()->user()->email == 'vipulkoli2323@gmail.com') ? 5 : $package->price;
                        @endphp
                        <div class="package-box">
                            <h4>{{ $package->name }}</h4>
                            <div class="form-group">
                                <p><strong>Package Description:</strong> {{ $package->description }}</p>
                                <p><strong>Package Price:</strong> ₹{{ number_format($displayPrice, 2) }}</p>
                                <button type="button" class="btn btn-primary razorpay-buy-btn"
                                    data-id="{{ $package->id }}"
                                    data-name="{{ $package->name }}"
                                    data-price="{{ $displayPrice }}">
                                Buy
                            </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="carousel-controls">
                    <button class="carousel-button" onclick="scrollCarousel('left', 'availablePackagesCarousel')">&#8249;</button>
                    <button class="carousel-button" onclick="scrollCarousel('right', 'availablePackagesCarousel')">&#8250;</button>
                </div>
            </div>
        </div>
    </div>


    <form id="purchaseForm" action="{{ route('purchase_packages.store') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="package_id" id="selected_package_id">
    </form>

    <script>
        let currentPackageId = null;
        let currentPackageName = null;
        let currentPackagePrice = null;
        let paymentAttempts = 0;
        const MAX_PAYMENT_ATTEMPTS = 3;

        function handleRazorpayPayment() {
            const buyBtn = document.querySelector('.razorpay-buy-btn[data-id="' + currentPackageId + '"]');
            const originalText = buyBtn ? buyBtn.innerHTML : '';
            if (buyBtn) {
                buyBtn.disabled = true;
                buyBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating Order...';
            }

            // 1. Create Order on the server
            fetch("{{ route('razorpay.createOrder') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    package_id: currentPackageId
                })
            })
            .then(res => {
                // Check if response is ok and content-type is JSON
                if (!res.ok) {
                    if (res.status === 401) {
                        throw new Error('Please login to continue');
                    } else if (res.status === 403) {
                        throw new Error('Access denied');
                    } else {
                        throw new Error('Server error occurred');
                    }
                }
                
                const contentType = res.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Invalid response format. Please try again or contact support.');
                }
                
                return res.json();
            })
            .then(orderData => {
                if (!orderData.success) {
                    throw new Error(orderData.message || 'Could not create order.');
                }

                // 2. Open Razorpay Checkout
                const options = {
                    key: orderData.key,
                    amount: orderData.amount,
                    currency: orderData.currency,
                    name: orderData.name,
                    description: orderData.description,
                    order_id: orderData.order_id,
                    handler: function (response){
                        console.log('Razorpay Payment Success Response:', response);
                        if (buyBtn) buyBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...';

                        // 3. Verify Payment on the server
                        fetch("{{ route('razorpay.verifyPayment') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature,
                                package_id: currentPackageId
                            })
                        })
                        .then(res => {
                            // Check if response is ok and content-type is JSON
                            if (!res.ok) {
                                if (res.status === 401) {
                                    throw new Error('Session expired. Please login again.');
                                } else if (res.status === 403) {
                                    throw new Error('Access denied');
                                } else {
                                    throw new Error('Payment verification failed');
                                }
                            }
                            
                            const contentType = res.headers.get('content-type');
                            if (!contentType || !contentType.includes('application/json')) {
                                throw new Error('Invalid response format during verification');
                            }
                            
                            return res.json();
                        })
                        .then(res => {
                            if(res.success) {
                                console.log('Payment Verification Success:', res);
                                const alertDiv = document.createElement('div');
                                alertDiv.className = 'alert alert-success alert-dismissible fade show';
                                alertDiv.role = 'alert';
                                alertDiv.innerHTML = `<strong>Success!</strong> ${orderData.name} purchased successfully.` +
                                                      `<p>Tokens received: ${res.package?.tokens || ''}</p>` +
                                                      `<p>Expires on: ${res.package?.expires_at || ''}</p>` +
                                                      `<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
                                const mainContent = document.querySelector('.main-content');
                                if (mainContent) mainContent.insertBefore(alertDiv, mainContent.firstChild);
                                setTimeout(() => window.location.reload(), 3000);
                            } else {
                                console.log('Payment Verification Failed:', res);
                                if (buyBtn){ buyBtn.disabled = false; buyBtn.innerHTML = originalText; }
                                alert('Payment failed: ' + (res.message || 'Unknown error'));
                                setTimeout(() => window.location.reload(), 3000);
                            }
                        })
                        .catch(err => {
                            console.error('Error verifying payment:', err);
                            if (buyBtn){ buyBtn.disabled = false; buyBtn.innerHTML = originalText; }
                            alert('Payment verification error: ' + err.message);
                        });
                    },
                    prefill: {
                        name: "{{ auth()->user()->name ?? '' }}",
                        email: "{{ auth()->user()->email ?? '' }}"
                    },
                    theme: { color: "#0F408F" },
                    modal: {
                        ondismiss: function () {
                            console.log('Checkout form closed by user');
                            if (buyBtn){ buyBtn.disabled = false; buyBtn.innerHTML = originalText; }
                        }
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();

                rzp.on('payment.failed', function (response) {
                    console.error('Payment failed:', response.error);
                    alert('Payment failed: ' + response.error.description);
                    if (buyBtn){ buyBtn.disabled = false; buyBtn.innerHTML = originalText; }
                });
            })
            .catch(err => {
                console.error('Error creating order:', err);
                if (buyBtn){ buyBtn.disabled = false; buyBtn.innerHTML = originalText; }
                alert('Could not initiate payment: ' + err.message);
            });
        }

        // Function to scroll the carousel left or right
        function scrollCarousel(direction, carouselId) {
            const carousel = document.getElementById(carouselId);
            const scrollAmount = 300; // Amount to scroll by in pixels

            if (direction === 'left') {
                carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            } else {
                carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }
    </script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.razorpay-buy-btn').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            currentPackageId = this.dataset.id;
            currentPackageName = this.dataset.name;
            currentPackagePrice = this.dataset.price;
            paymentAttempts = 0;
            
            handleRazorpayPayment();
        });
    });
});
</script>

 

</x-layout.user_banner>
