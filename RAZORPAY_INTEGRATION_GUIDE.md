# Razorpay Payment Gateway Integration Guide

## ✅ Implementation Status

The Razorpay payment gateway has been **successfully implemented** in the Aditya Matrimony project. All necessary files and configurations from the Maratha Matrimony project have been properly set up.

## 📁 File Structure

### Controllers
- **Location:** `app/Http/Controllers/RazorpayController.php`
- **Purpose:** Handles payment order creation, payment verification, and failure handling
- **Key Methods:**
  - `createOrder()` - Creates a Razorpay order
  - `verifyPayment()` - Verifies payment signature and processes package purchase
  - `failure()` - Handles payment failures

### Routes
- **Location:** `routes/web.php`
- **Configured Routes:**
  ```php
  Route::post('/razorpay/order', [RazorpayController::class, 'createOrder'])->name('razorpay.createOrder');
  Route::post('/razorpay/verify', [RazorpayController::class, 'verifyPayment'])->name('razorpay.verifyPayment');
  Route::post('/razorpay/failure', [RazorpayController::class, 'failure'])->name('razorpay.failure');
  ```

### Configuration
- **Location:** `config/services.php`
- **Configuration:**
  ```php
  'razorpay' => [
      'key' => env('RAZORPAY_API_KEY'),
      'secret' => env('RAZORPAY_API_SECRET'),
  ],
  ```

### Views
- **Main View:** `resources/views/razorpay/index.blade.php`
- **Component:** `resources/views/components/razorpay-form.blade.php`
- **Package Views:** `resources/views/default/view/profile/user_packages/create.blade.php`

### Dependencies
- **Package:** `razorpay/razorpay` v2.9.1
- **Status:** ✅ Installed via Composer

## 🔧 Configuration Steps

### 1. Environment Variables
Add the following to your `.env` file:
```env
RAZORPAY_API_KEY=your_razorpay_test_or_live_key
RAZORPAY_API_SECRET=your_razorpay_test_or_live_secret
```

**Note:** These variables are already defined in `.env.example` as a template.

### 2. Get Razorpay API Credentials
1. Sign up/Login to [Razorpay Dashboard](https://dashboard.razorpay.com/)
2. Navigate to Settings → API Keys
3. Generate Test/Live API keys
4. Copy the Key ID and Secret Key

### 3. Database Requirements
Ensure the following tables exist:
- `packages` - Stores available packages
- `profile_packages` - Stores user package purchases
- `profiles` - User profile information

## 💳 Payment Flow

1. **User selects a package** from the packages page
2. **Frontend JavaScript** calls `/razorpay/order` to create an order
3. **Server creates order** using Razorpay API
4. **Razorpay checkout modal** opens for payment
5. **User completes payment** (Card/UPI/NetBanking/Wallet)
6. **Payment signature verified** at `/razorpay/verify`
7. **Package activated** for the user
8. **Tokens credited** to user's account

## 🧪 Testing the Integration

### Test Mode
1. Use Razorpay test credentials (start with `rzp_test_`)
2. Test card details:
   - **Card Number:** 4111 1111 1111 1111
   - **CVV:** Any 3 digits
   - **Expiry:** Any future date

### Test Payment Flow
1. Login to the application
2. Navigate to packages page
3. Select a package and click "Buy Now"
4. Complete payment using test credentials
5. Verify tokens are credited

## 🎨 Frontend Implementation

The frontend uses Razorpay's JavaScript SDK:
```html
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
```

JavaScript implementation handles:
- Order creation via AJAX
- Opening Razorpay checkout
- Payment verification
- Error handling
- User feedback

## ⚠️ Important Notes

1. **Security:**
   - Never expose API Secret in frontend code
   - Always verify payment signature on server
   - Use HTTPS in production

2. **Error Handling:**
   - Payment failures are logged
   - User-friendly error messages displayed
   - Retry mechanism available

3. **Production Checklist:**
   - [ ] Replace test credentials with live credentials
   - [ ] Test all payment methods
   - [ ] Configure webhooks for payment status
   - [ ] Set up payment receipt emails
   - [ ] Enable payment logs monitoring

## 📝 Troubleshooting

### Common Issues:

1. **"Invalid API Key" Error**
   - Verify `.env` file has correct credentials
   - Clear config cache: `php artisan config:clear`

2. **"Amount should be integer" Error**
   - Check package prices are properly formatted
   - Ensure amount conversion to paise is correct

3. **Payment Not Reflecting**
   - Check database transactions
   - Verify profile_packages table updates
   - Check Laravel logs for errors

### Debug Commands:
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Check logs
tail -f storage/logs/laravel.log
```

## 📞 Support

- **Razorpay Support:** https://razorpay.com/support/
- **Razorpay Docs:** https://razorpay.com/docs/
- **API Reference:** https://razorpay.com/docs/api/

## ✨ Features Implemented

- ✅ Order creation with package details
- ✅ Automatic payment capture
- ✅ Signature verification
- ✅ Package activation on successful payment
- ✅ Token management
- ✅ Payment failure handling
- ✅ Transaction logging
- ✅ User-friendly error messages
- ✅ Responsive payment UI

## 🚀 Ready to Go!

The Razorpay integration is fully functional. Just add your API credentials to the `.env` file and you're ready to accept payments!
