<x-layout.auth>
    <div
        class="flex justify-center items-center min-h-screen bg-[url('/assets/images/map.svg')] dark:bg-[url('/assets/images/map-dark.svg')] bg-cover bg-center">
        <div class="panel sm:w-[480px] m-6 max-w-lg w-full">
            <h2 class="font-bold text-2xl mb-3">Sign In</h2>
            <p class="mb-7">Enter your email and password to login</p>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form class="space-y-5" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-input" value="{{ old('email') }}" placeholder="Enter Email" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <style>
                        /* Hide native password reveal icon in Edge/IE */
                        input[type="password"]::-ms-reveal,
                        input[type="password"]::-ms-clear {
                            display: none;
                        }
                    </style>
                    <label for="password">Password</label>
                    <div class="text-white-dark mt-1" style="position: relative;">
                        <input id="password" name="password" type="password" class="form-input" style="width: 100%; padding-right: 2.5rem;" placeholder="Enter Password" required autocomplete="current-password" />
                        <span id="toggleAdminPassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 10;">
                            <svg id="adminEyeOpen" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                            </svg>
                            <svg id="adminEyeClosed" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash hidden" viewBox="0 0 16 16">
                                <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486z"/>
                                <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                                <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                            </svg>
                        </span>
                    </div>
                    <input id="is_admin" name="is_admin" type="hidden" value="true" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const toggleAdminPassword = document.getElementById('toggleAdminPassword');
                            const adminPassword = document.getElementById('password');
                            const adminEyeOpen = document.getElementById('adminEyeOpen');
                            const adminEyeClosed = document.getElementById('adminEyeClosed');
                            
                            if (toggleAdminPassword && adminPassword) {
                                toggleAdminPassword.addEventListener('click', function () {
                                    const type = adminPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                                    adminPassword.setAttribute('type', type);
                                    
                                    if (type === 'password') {
                                        adminEyeOpen.classList.remove('hidden');
                                        adminEyeClosed.classList.add('hidden');
                                    } else {
                                        adminEyeOpen.classList.add('hidden');
                                        adminEyeClosed.classList.remove('hidden');
                                    }
                                });
                            }
                        });
                    </script>
                </div>
                <div>
                    <label for="remember_me" class="cursor-pointer">
                        <input id="remember_me" name="remember" type="checkbox" class="form-checkbox" />
                        <span class="text-white-dark">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-full">SIGN IN</button>
            </form>
            <div
                class="relative my-7 h-5 text-center before:w-full before:h-[1px] before:absolute before:inset-0 before:m-auto before:bg-[#ebedf2] dark:before:bg-[#253b5c]">
                <div class="font-bold text-white-dark bg-white dark:bg-[#0e1726] px-2 relative z-[1] inline-block">
                    <span>OR</span></div>
            </div>
            @if (Route::has('password.request'))
                <p class="text-center">
                    <a class="text-primary font-bold hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </p>
            @endif
        </div>
    </div>

</x-layout.auth>