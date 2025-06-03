<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WelcomeNotification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Mail;
use Illuminate\Http\JsonResponse;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            try {
                // We need to intercept the password reset link creation
                // First, create a token
                $token = Password::createToken($user);
                
                // Log the reset link details for debugging
                $resetUrl = URL::to(route('password.reset', [
                    'token' => $token,
                    'email' => $request->email,
                ], false));
                
                Log::info('Password reset link generated', [
                    'email' => $request->email,
                    'reset_url' => $resetUrl,
                    'token' => $token,
                    'env_variables' => [
                        'MAIL_MAILER' => env('MAIL_MAILER'),
                        'MAIL_HOST' => env('MAIL_HOST'),
                        'MAIL_PORT' => env('MAIL_PORT'),
                        'MAIL_USERNAME' => env('MAIL_USERNAME'),
                        'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
                        'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
                        'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
                        'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
                        'APP_ENV' => env('APP_ENV')
                    ],
                    'config_values' => [
                        'mail.default' => config('mail.default'),
                        'host' => config('mail.mailers.smtp.host'),
                        'port' => config('mail.mailers.smtp.port'),
                        'username' => config('mail.mailers.smtp.username'),
                        'encryption' => config('mail.mailers.smtp.encryption'),
                        'from_address' => config('mail.from.address'),
                        'from_name' => config('mail.from.name')
                    ]
                ]);
                
                // Force log an explicit message with the reset link for easy access
                Log::info("RESET LINK: {$resetUrl}", [
                    'email' => $request->email,
                    'token' => $token
                ]);
                
                // Now send the reset link as normal
                $status = Password::sendResetLink(
                    $request->only('email')
                );
                
                // Check and log if the email was sent
                if ($status === Password::RESET_LINK_SENT) {
                    Log::info('Password reset email sent successfully', ['email' => $request->email]);
                } else {
                    Log::warning('Failed to send password reset email', ['email' => $request->email, 'status' => $status]);
                }
                
                // Notification::sendNow($user, new WelcomeNotification());
            } catch (\Exception $e) {
                Log::error('Exception during password reset', [
                    'email' => $request->email,
                    'exception' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                
                return back()->withInput($request->only('email'))
                             ->withErrors(['email' => 'An error occurred. Please try again later.']);
            }
        } else {
            // Log the attempt for non-existent email
            Log::info('Password reset requested for non-existent email', ['email' => $request->email]);
            
            // Return with an alert message for non-existent email
            return back()->withInput($request->only('email'))
                         ->with('error', 'We could not find a user with that email address.');
        }

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    /**
     * Handle an incoming API password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmailApi(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Log::info('API: Password reset requested for non-existent email', ['email' => $request->email]);
            return response()->json(['message' => 'We can\'t find a user with that email address.'], 404);
        }

        try {
            // Log the attempt details for debugging
            // Note: The token and URL logged here are for diagnostics; 
            // Password::sendResetLink handles the actual token generation and notification.
            $tokenForLog = Password::createToken($user);
            $resetUrlForLog = URL::to(route('password.reset', [
                'token' => $tokenForLog,
                'email' => $request->email,
            ], false));

            Log::info('API: Password reset link generation attempt', [
                'email' => $request->email,
                'reset_url_would_be' => $resetUrlForLog,
                'env_variables' => [
                    'MAIL_MAILER' => env('MAIL_MAILER'),
                    'BREVO_API_KEY_EXISTS' => !empty(env('BREVO_API_KEY')),
                    'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
                    'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
                ],
                'config_values' => [
                    'mail.default' => config('mail.default'),
                    'mail.mailers.brevo' => config('mail.mailers.brevo', 'NOT_CONFIGURED'),
                    'services.brevo.key_exists' => !empty(config('services.brevo.key', null)),
                    'from_address' => config('mail.from.address'),
                    'from_name' => config('mail.from.name')
                ]
            ]);

            // Attempt to send the reset link email using Laravel's Password facade
            $status = Password::sendResetLink($request->only('email'));

            if ($status == Password::RESET_LINK_SENT) {
                Log::info('API: Password reset email sent successfully', ['email' => $request->email, 'status' => $status]);
                return response()->json(['message' => __($status)], 200);
            } else {
                Log::warning('API: Failed to send password reset email', ['email' => $request->email, 'status' => $status]);
                $statusCode = ($status == Password::THROTTLED) ? 429 : 422; // 422 for other errors like INVALID_USER (though pre-checked)
                return response()->json(['message' => __($status)], $statusCode);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            // This catch block is a fallback; $request->validate() typically handles this.
            Log::error('API: Validation exception during password reset', [
                'email' => $request->email,
                'errors' => $e->errors(),
                'exception' => $e->getMessage()
            ]);
            return response()->json(['message' => $e->getMessage(), 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('API: General exception during password reset', [
                'email' => $request->email,
                'exception' => $e->getMessage(),
                // 'trace' => $e->getTraceAsString() // Uncomment for detailed debugging if needed, but be cautious in production
            ]);
            return response()->json(['message' => 'An error occurred while attempting to send the password reset link. Please try again later.'], 500);
        }
    }
}