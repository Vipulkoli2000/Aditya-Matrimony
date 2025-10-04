<x-layout.user_banner>
    <style>
        /* Page container styling */
        .min-vh-100 {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Card styling for 3D effect and modern look */
        .card {
            width: 100%;
            max-width: 500px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15), 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 3rem;
            text-align: center;
        }

        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1.5rem;
        }

        .success-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .success-message {
            font-size: 1.1rem;
            color: #718096;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .password-info {
            background-color: #f8f9fa;
            border: 2px solid #28a745;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .password-label {
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .password-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #28a745;
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
        }

        .btn-login {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-login:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }

        /* Animation for success icon */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .success-icon {
            animation: bounce 2s infinite;
        }
    </style>

    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card">
            <div class="card-body">
                <!-- Success Icon -->
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>

                <!-- Success Title -->
                <h1 class="success-title">Registration Successful!</h1>

                <!-- Success Message -->
                <p class="success-message">
                    Your account has been created successfully. You can now use the credentials below to login to your account.
                </p>

                <!-- Password Information -->
                <div class="password-info">
                    <div class="password-label">Your Login Password:</div>
                    <div class="password-value">Aditya123</div>
                </div>

                <!-- Login Button -->
                <a href="{{ route('login') }}" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Go to Login Page
                </a>
            </div>
        </div>
    </div>
</x-layout.user_banner>
