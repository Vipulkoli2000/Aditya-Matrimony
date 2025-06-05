<x-layout.user_banner>
    <style>
        /* New wrapper to hold panel and sidebar side-by-side */
        .content-wrapper {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
        }
        
        /* Sidebar style */
        .sidebar {
            width: 300px;
            position: sticky;
            top: 0;
            height: 100vh;
            background-color: #f5f5f5;
            padding: 15px;
            border-left: 1px solid #ddd;
        }

        /* Main content area now becomes a flex item that takes remaining space */
        .main-content {
            flex: 1;
            max-width: 900px; /* Adjust width as needed */
            margin: 0 auto;
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

        #loadingModal .modal-content {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
        }
        
        #loadingModal .spinner-border {
            width: 3rem;
            height: 3rem;
        }
        
        .modal-backdrop.show {
            opacity: 0.7;
        }
        
        #paymentFailedModal .modal-header {
            border-bottom: none;
        }
        
        #paymentFailedModal .modal-footer {
            border-top: none;
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

        /* Add these new styles for modal centering */
        .modal-dialog.modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }
        
        /* Ensure modal content is properly centered */
        .modal-content {
            width: 100%;
            margin: auto;
        }
        
        /* Media queries for mobile responsiveness */
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
                max-width: 100%;
                margin: 0;
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
            .modal-dialog {
                width: 100%;
                margin: 0;
            }
        }
    </style>

    <!-- Wrap the panel and sidebar in the new flex container -->
    <div class="content-wrapper">
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
                                    <a href="{{ route('generate.invoice', $purchased_package->id) }}" class="btn btn-primary btn-sm" target="_blank">
                                     Invoice
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
                            <div class="package-box">
                                <h4>{{ $package->name }}</h4>
                                <div class="form-group">
                                    <p><strong>Package Description:</strong> {{ $package->description }}</p>
                                    <p><strong>Package Price:</strong> ₹{{ number_format($package->price, 2) }}</p>
                                    <button type="button" class="btn btn-primary razorpay-buy-btn"
    data-id="{{ $package->id }}"
    data-name="{{ $package->name }}"
    data-price="{{ $package->price }}">
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

        
    </div>

    <!-- Payment Confirmation Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Confirm Payment</h5>
                    <button onclick="location.reload();" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to proceed with the payment?</p>
                    <p><strong>Package:</strong> <span id="packageName"></span></p>
                    <p><strong>Amount:</strong> ₹<span id="packagePrice"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="handlePaymentNo()">No</button>
                    <button type="button" class="btn btn-primary" onclick="handlePaymentYes()">Yes, Pay Now</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Loading Spinner Modal -->
    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Processing payment...</span>
                    </div>
                    <p class="mt-2">Processing your payment...</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paymentFailedModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Payment Failed</h5>
                    <button onclick="location.reload();" type="button" class="close text-black" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 48px;"></i>
                    </div>
                    <p class="text-center">Your payment was not successful.</p>
                    <p class="text-center" id="paymentErrorMessage">Please try again or choose a different payment method.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                    onclick="location.reload();"
                  >
                    Cancel
                  </button>
                                      <button type="button" class="btn btn-primary" onclick="retryPayment()">Try Again</button>
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

        function confirmPayment(packageId, packageName, packagePrice) {
            currentPackageId = packageId;
            currentPackageName = packageName;
            currentPackagePrice = packagePrice;
            paymentAttempts = 0;
            
            document.getElementById('packageName').textContent = packageName;
            document.getElementById('packagePrice').textContent = parseFloat(packagePrice).toFixed(2);
            $('#paymentModal').modal('show');
        }

        function handlePaymentYes() {
            $('#paymentModal').modal('hide');
            // Razorpay integration
            var options = {
                "key": "{{ config('services.razorpay.key') }}",
                "amount": (parseFloat(currentPackagePrice) * 100).toFixed(0),
                "name": currentPackageName,
                "description": "Purchase " + currentPackageName,
                "modal": {
                    "ondismiss": function() {
                        console.log('Payment modal dismissed');
                    }
                },
                "handler": function (response){
                    // Show loading message
                    $('#loadingModal').modal('show');
                    
                    fetch("{{ route('razorpay.payment') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            razorpay_payment_id: response.razorpay_payment_id,
                            package_id: currentPackageId
                        })
                    })
                    .then(res => {
                        if (!res.ok) {
                            throw new Error(`HTTP error! Status: ${res.status}`);
                        }
                        return res.json();
                    })
                    .then(res => {
                        $('#loadingModal').modal('hide');
                        if(res.success) {
                            // Create success alert
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'alert alert-success alert-dismissible fade show';
                            alertDiv.role = 'alert';
                            alertDiv.innerHTML = `
                                <strong>Success!</strong> ${currentPackageName} purchased successfully.
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
                            document.getElementById('paymentErrorMessage').textContent = res.message || res.error || "Payment failed. Please try again.";
                            $('#paymentFailedModal').modal('show');
                        }
                    })
                    .catch(err => {
                        $('#loadingModal').modal('hide');
                        console.error('Error processing payment:', err);
                        document.getElementById('paymentErrorMessage').textContent = "Payment processing error. Please try again.";
                        $('#paymentFailedModal').modal('show');
                    });
                },
                "prefill": {
                    "name": "{{ auth()->user()->name ?? '' }}",
                    "email": "{{ auth()->user()->email ?? '' }}"
                },
                "theme": {
                    "color": "#0F408F"
                }
            };
            
            // Initialize Razorpay
            var rzp = new Razorpay(options);
            
            // Add event handlers for better error tracking
            rzp.on('payment.success', function(response) {
                console.log('Payment success event triggered', response);
                // This is already handled by the handler function
            });
            
            rzp.open();
            
            // Handle payment failures
            rzp.on('payment.failed', function (response) {
                console.error('Payment failed:', response.error);
                $('#loadingModal').modal('hide');
                
                // Record payment failure in the database
                fetch("{{ route('razorpay.failure') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        response: response
                    })
                }).catch(e => console.error('Error logging payment failure:', e));
                
                document.getElementById('paymentErrorMessage').textContent = response.error.description || "Payment failed. Please try again.";
                $('#paymentFailedModal').modal('show');
            });
        }

        function handlePaymentNo() {
            $('#paymentModal').modal('hide');
            document.getElementById('paymentErrorMessage').textContent = "Payment cancelled. You can try again when ready.";
            setTimeout(() => {
                $('#paymentFailedModal').modal('show');
            }, 500);
        }

        function retryPayment() {
            if (paymentAttempts >= MAX_PAYMENT_ATTEMPTS) {
                $('#paymentFailedModal').modal('hide');
                alert('Maximum payment attempts reached. Please try again later.');
                return;
            }
            
            $('#paymentFailedModal').modal('hide');
            setTimeout(() => {
                confirmPayment(currentPackageId, currentPackageName, currentPackagePrice);
            }, 500);
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

        $(document).ready(function() {
            // Initialize the modal
            $('#paymentFailedModal').modal({
                backdrop: 'static',
                keyboard: false,
                show: false
            });

            // Handle modal close button
            $('#paymentFailedModal .close').on('click', function() {
                $('#paymentFailedModal').modal('hide');
            });

            // Handle modal hidden event
            $('#paymentFailedModal').on('hidden.bs.modal', function () {
                paymentAttempts = 0; // Reset payment attempts when modal is closed
            });
        });
    </script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
let selectedPackageId = null;
let selectedPackageName = '';
let selectedPackagePrice = 0;

// Safely create userState and userCountry variables
const userState = "{{ $user->state ?? '' }}";
const userCountry = "{{ $user->country ?? '' }}";

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.razorpay-buy-btn').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (!userCountry) {
                $('#infoModalMessage').text('Please provide your contact details to proceed.');
                $('#infoModal').modal('show');
                return;
            }
            currentPackageId = this.dataset.id;
            currentPackageName = this.dataset.name;
            currentPackagePrice = this.dataset.price;
            paymentAttempts = 0;
            
            document.getElementById('packageName').textContent = currentPackageName;
            document.getElementById('packagePrice').textContent = parseFloat(currentPackagePrice).toFixed(2);
            $('#paymentModal').modal('show');
        });
    });
});
</script>

<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p id="infoModalMessage" class="mb-0"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.reload();">OK</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='/profile/contact_details';">Go to contact details</button>
            </div>
        </div>
    </div>
</div>

</x-layout.user_banner>
