<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset='utf-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Aditya Matrimony') }}</title>

    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <link rel="icon" type="image/svg" href="/assets/user/img/favicon.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/highlight.min.css') }}">
    <link rel='stylesheet' type='text/css' href="{{ Vite::asset('resources/css/nice-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ Vite::asset('resources/css/quill.snow.css') }}" />
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/swiper-bundle.min.css') }}">


    <script src="/assets/js/perfect-scrollbar.min.js"></script>
    <script defer src="/assets/js/popper.min.js"></script>
    <script defer src="/assets/js/tippy-bundle.umd.min.js"></script>
    <script defer src="/assets/js/sweetalert.min.js"></script>
    <script src="/assets/js/quill.js"></script>
    @vite(['resources/css/app.css'])
</head>

<body x-data="main" class="antialiased relative font-nunito text-sm font-normal overflow-x-hidden"
    :class="[$store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout, $store.app
        .rtlClass
    ]">

    <!-- sidebar menu overlay -->
    <div x-cloak class="fixed inset-0 bg-[black]/60 z-50 lg:hidden" :class="{ 'hidden': !$store.app.sidebar }"
        @click="$store.app.toggleSidebar()"></div>

    <!-- screen loader -->
    <div
        class="screen_loader fixed inset-0 bg-[#fafafa] dark:bg-[#060818] z-[60] grid place-content-center animate__animated">
        <svg width="64" height="64" viewBox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#4361ee">
            <path
                d="M67.447 58c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10zm9.448 9.447c0 5.523 4.477 10 10 10 5.522 0 10-4.477 10-10s-4.478-10-10-10c-5.523 0-10 4.477-10 10zm-9.448 9.448c-5.523 0-10 4.477-10 10 0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zM58 67.447c0-5.523-4.477-10-10-10s-10 4.477-10 10 4.477 10 10 10 10-4.477 10-10z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="-360 67 67" dur="2.5s"
                    repeatCount="indefinite" />
            </path>
            <path
                d="M28.19 40.31c6.627 0 12-5.374 12-12 0-6.628-5.373-12-12-12-6.628 0-12 5.372-12 12 0 6.626 5.372 12 12 12zm30.72-19.825c4.686 4.687 12.284 4.687 16.97 0 4.686-4.686 4.686-12.284 0-16.97-4.686-4.687-12.284-4.687-16.97 0-4.687 4.686-4.687 12.284 0 16.97zm35.74 7.705c0 6.627 5.37 12 12 12 6.626 0 12-5.373 12-12 0-6.628-5.374-12-12-12-6.63 0-12 5.372-12 12zm19.822 30.72c-4.686 4.686-4.686 12.284 0 16.97 4.687 4.686 12.285 4.686 16.97 0 4.687-4.686 4.687-12.284 0-16.97-4.685-4.687-12.283-4.687-16.97 0zm-7.704 35.74c-6.627 0-12 5.37-12 12 0 6.626 5.373 12 12 12s12-5.374 12-12c0-6.63-5.373-12-12-12zm-30.72 19.822c-4.686-4.686-12.284-4.686-16.97 0-4.686 4.687-4.686 12.285 0 16.97 4.686 4.687 12.284 4.687 16.97 0 4.687-4.685 4.687-12.283 0-16.97zm-35.74-7.704c0-6.627-5.372-12-12-12-6.626 0-12 5.373-12 12s5.374 12 12 12c6.628 0 12-5.373 12-12zm-19.823-30.72c4.687-4.686 4.687-12.284 0-16.97-4.686-4.686-12.284-4.686-16.97 0-4.687 4.686-4.687 12.284 0 16.97 4.686 4.687 12.284 4.687 16.97 0z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="360 67 67" dur="8s"
                    repeatCount="indefinite" />
            </path>
        </svg>
    </div>

    <div class="fixed bottom-6 ltr:right-6 rtl:left-6 z-50" x-data="scrollToTop">
        <template x-if="showTopButton">
            <button type="button"
                class="btn btn-outline-primary rounded-full p-2 animate-pulse bg-[#fafafa] dark:bg-[#060818] dark:hover:bg-primary"
                @click="goToTop">
                <svg width="24" height="24" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 20.75C12.4142 20.75 12.75 20.4142 12.75 20L12.75 10.75L11.25 10.75L11.25 20C11.25 20.4142 11.5858 20.75 12 20.75Z"
                        fill="currentColor" />
                    <path
                        d="M6.00002 10.75C5.69667 10.75 5.4232 10.5673 5.30711 10.287C5.19103 10.0068 5.25519 9.68417 5.46969 9.46967L11.4697 3.46967C11.6103 3.32902 11.8011 3.25 12 3.25C12.1989 3.25 12.3897 3.32902 12.5304 3.46967L18.5304 9.46967C18.7449 9.68417 18.809 10.0068 18.6929 10.287C18.5768 10.5673 18.3034 10.75 18 10.75L6.00002 10.75Z"
                        fill="currentColor" />
                </svg>
            </button>
        </template>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("scrollToTop", () => ({
                showTopButton: false,
                init() {
                    window.onscroll = () => {
                        this.scrollFunction();
                    };
                },

                scrollFunction() {
                    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                        this.showTopButton = true;
                    } else {
                        this.showTopButton = false;
                    }
                },

                goToTop() {
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                },
            }));
        });
    </script>

    <!-- <x-common.theme-customiser /> -->

    <div class="main-container text-black dark:text-white-dark min-h-screen" :class="[$store.app.navbar]">

        <x-common.sidebar />

        <div class="main-content">
            <x-common.header />
            @if(Session::has('success'))
                <x-common.alert :success='true'> {{ session('success') }}</x-common.alert> 
            @elseif(Session::has('error'))
                <x-common.alert > {{ session('error') }} </x-common.alert > 
            @endif

            <div class="p-6 animate__animated" :class="[$store.app.animation]">
                {{ $slot }}

                <x-common.footer />
            </div>
        </div>
    </div>
    <script src="/assets/js/alpine-collaspe.min.js"></script>
    <script src="/assets/js/alpine-persist.min.js"></script>
    <script defer src="/assets/js/alpine-ui.min.js"></script>
    <script defer src="/assets/js/alpine-focus.min.js"></script>
    <script defer src="/assets/js/alpine.min.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/flatpickr.js"></script>
    <script src="/assets/js/nice-select2.js"></script>
    <script src="/assets/js/highlight.min.js"></script>
    <script src="/assets/js/swiper-bundle.min.js"></script>
    <script src="/assets/js/simple-datatables.js"></script>

    <!-- Share Link Modal -->
    @if(Auth::guard('franchise')->check())
    <div id="shareLinkModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-96 max-w-md mx-auto">
            <!-- Header with Icon -->
            <div class="text-center pt-6 pb-2">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Share Registration Link</h3>
                <p class="text-sm text-blue-600 px-4 leading-tight">Share this link with users to register with your franchise code</p>
            </div>
            
            <!-- Link Input -->
            <div class="px-4 py-4">
                <div class="relative flex items-stretch">
                    <input type="text" id="franchiseLink" readonly 
                           class="flex-1 py-3 pl-3 pr-3 border border-gray-200 rounded-l-lg bg-gray-50 text-xs text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-100 border-r-0"
                           value="{{ url('/register?franchise_code=' . Auth::guard('franchise')->user()->franchise_code) }}">
                    <button onclick="copyFranchiseLink()" 
                            class="px-3 py-3 text-gray-400 hover:text-blue-600 hover:bg-blue-50 bg-gray-50 border border-gray-200 rounded-r-lg border-l-gray-300 transition-all duration-200"
                            title="Copy Link">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex border-t border-gray-200">
                <button onclick="closeShareLinkModal()" 
                        class="flex-1 py-3 text-gray-600 hover:text-gray-800 font-medium transition-colors text-sm">
                    Cancel
                </button>
                <div class="w-px bg-gray-200"></div>
                <button onclick="copyFranchiseLink()" 
                        class="flex-1 py-3 text-blue-600 hover:text-blue-800 font-medium transition-colors text-sm">
                    Copy Link
                </button>
            </div>
        </div>
    </div>

    <script>
        function openShareLinkModal() {
            document.getElementById('shareLinkModal').classList.remove('hidden');
        }

        function closeShareLinkModal() {
            document.getElementById('shareLinkModal').classList.add('hidden');
        }

        function copyFranchiseLink() {
            const linkInput = document.getElementById('franchiseLink');
            
            // Modern clipboard API
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(linkInput.value).then(() => {
                    showCopySuccess();
                }).catch(err => {
                    console.error('Failed to copy: ', err);
                    fallbackCopyTextToClipboard(linkInput.value);
                });
            } else {
                // Fallback for older browsers
                fallbackCopyTextToClipboard(linkInput.value);
            }
        }

        function fallbackCopyTextToClipboard(text) {
            const linkInput = document.getElementById('franchiseLink');
            linkInput.select();
            linkInput.setSelectionRange(0, 99999);
            
            try {
                document.execCommand('copy');
                showCopySuccess();
            } catch (err) {
                console.error('Failed to copy link: ', err);
                alert('Failed to copy link. Please copy manually.');
            }
        }

        function showCopySuccess() {
            // Update all copy buttons
            const copyButtons = document.querySelectorAll('[onclick="copyFranchiseLink()"]');
            copyButtons.forEach((button, index) => {
                if (index === 0) { // The button inside the input field
                    const originalHTML = button.innerHTML;
                    
                    // Change to success state with checkmark icon
                    button.innerHTML = `
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    `;
                    button.classList.add('text-green-600', 'bg-green-50');
                    button.classList.remove('text-gray-400', 'hover:bg-blue-50', 'bg-gray-50');
                    
                    setTimeout(() => {
                        button.innerHTML = originalHTML;
                        button.classList.remove('text-green-600', 'bg-green-50');
                        button.classList.add('text-gray-400', 'bg-gray-50');
                    }, 1500);
                } else { // Other copy buttons (like the one at the bottom)
                    const originalText = button.textContent;
                    button.textContent = 'Copied!';
                    button.classList.add('text-green-600');
                    button.classList.remove('text-blue-600');
                    
                    setTimeout(() => {
                        button.textContent = originalText;
                        button.classList.remove('text-green-600');
                        button.classList.add('text-blue-600');
                    }, 1500);
                }
            });
            
            // Auto close modal after successful copy
            setTimeout(() => {
                closeShareLinkModal();
            }, 2000);
        }

        // Close modal when clicking outside
        document.getElementById('shareLinkModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeShareLinkModal();
            }
        });
    </script>
    @endif

</body>

</html>
