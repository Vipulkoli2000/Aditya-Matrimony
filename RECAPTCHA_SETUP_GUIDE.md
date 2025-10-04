# Google reCAPTCHA Integration Guide for Aditya Matrimony

## Overview
Google reCAPTCHA has been successfully implemented on the registration page to prevent bot registrations and enhance security.

## Configuration Steps

### 1. Get Google reCAPTCHA Keys
1. Visit [Google reCAPTCHA Console](https://www.google.com/recaptcha/admin)
2. Create a new site or use an existing one
3. Choose reCAPTCHA v2 ("I'm not a robot" Checkbox)
4. Add your domain (e.g., `localhost`, `yourdomain.com`)
5. Get your Site Key and Secret Key

### 2. Environment Configuration
Add the following variables to your `.env` file:

```env
# Google reCAPTCHA Configuration
RECAPTCHA_ENABLED=true
RECAPTCHA_SITE_KEY=your_actual_site_key_here
RECAPTCHA_SECRET_KEY=your_actual_secret_key_here
```

### 3. Enable/Disable reCAPTCHA
- Set `RECAPTCHA_ENABLED=true` to enable reCAPTCHA
- Set `RECAPTCHA_ENABLED=false` to disable reCAPTCHA

## Implementation Details

### Files Modified
1. **Composer Package**: `anhskohbo/no-captcha` installed
2. **Config**: `config/services.php` - Added reCAPTCHA configuration
3. **Environment**: `.env.example` - Added reCAPTCHA variables template
4. **View**: `resources/views/auth/register.blade.php` - Added reCAPTCHA widget
5. **Controller**: `app/Http/Controllers/Auth/RegisteredUserController.php` - Added validation

### How It Works
1. **Frontend**: reCAPTCHA widget appears on the registration form (step 4)
2. **Validation**: Form validates reCAPTCHA response before submission
3. **Backend**: Controller verifies reCAPTCHA with Google's servers
4. **Security**: Only verified human users can complete registration

### Location in Registration Form
The reCAPTCHA widget appears in step 4 of the registration process, after the terms and conditions checkbox and before the register button.

## Testing
1. Set `RECAPTCHA_ENABLED=true` in your `.env`
2. Add your actual reCAPTCHA keys
3. Visit the registration page
4. Complete the registration form
5. Verify reCAPTCHA appears in step 4
6. Test both successful and failed reCAPTCHA scenarios

## Troubleshooting

### reCAPTCHA Not Showing
- Check if `RECAPTCHA_ENABLED=true` in `.env`
- Verify Site Key is correct
- Check browser console for JavaScript errors
- Ensure domain is added to reCAPTCHA console

### Validation Failing
- Verify Secret Key is correct
- Check server logs for reCAPTCHA API errors
- Ensure server can make HTTP requests to google.com

### Development Environment
- Add `localhost` to your reCAPTCHA site domains
- Use HTTP or HTTPS consistently

## Security Notes
- Never expose your Secret Key in client-side code
- Site Key can be public (it's shown in HTML)
- reCAPTCHA helps prevent automated bot registrations
- Consider rate limiting for additional security

## Support
For issues with reCAPTCHA integration, check:
1. Google reCAPTCHA documentation
2. Laravel HTTP client documentation
3. Server error logs in `storage/logs/`
