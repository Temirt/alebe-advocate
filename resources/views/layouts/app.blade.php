<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Alebe Advocate - Professional Legal Services in Ethiopia')">
    <title>@yield('title', 'Alebe Advocate') | Professional Legal Services</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#1e3a5f',
                        secondary: '#c9a227',
                        accent: '#8b0000',
                    }
                }
            }
        }
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
        .chat-message { display: flex; flex-direction: column; max-width: 80%; margin-bottom: 8px; font-size: 0.875rem; }
        .chat-message--user { align-self: flex-end; align-items: flex-end; margin-left: auto; }
        .chat-message--assistant { align-self: flex-start; align-items: flex-start; }
        .chat-message--user .chat-bubble { background-color: #1e3a5f; color: white; border-radius: 8px 8px 0 8px; padding: 8px 12px; }
        .chat-message--assistant .chat-bubble { background-color: #f3f4f6; color: #111827; border-radius: 8px 8px 8px 0; padding: 8px 12px; }
        html[data-theme="dark"] .chat-message--assistant .chat-bubble { background-color: #374151; color: #f9fafb; }
        /* Minimal fallback if Tailwind CDN fails to load */
        nav.bg-primary { position: fixed; top: 0; left: 0; right: 0; z-index: 50; background: #1e3a5f; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        nav .max-w-7xl { max-width: 80rem; margin: 0 auto; padding: 0 1rem; }
        nav .h-20 { height: 80px; }
        nav .flex { display: flex; }
        nav .items-center { align-items: center; }
        nav .justify-between { justify-content: space-between; }
        nav .space-x-3 > * + * { margin-left: 0.75rem; }
        nav .max-w-7xl > .flex > div:nth-child(2) { display: flex; align-items: center; gap: 1rem; flex-wrap: nowrap; white-space: nowrap; }
        nav .max-w-7xl > .flex > div:nth-child(2) > * { white-space: nowrap; }
        nav .max-w-7xl > .flex > div:nth-child(3) { display: none; }
        main { padding-top: 80px; }
    </style>
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-200">
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="pt-14">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white font-serif text-lg font-bold mb-4">{{ __('site.site_name') }}</h3>
                    <p class="text-sm mb-4">{{ __('site.footer_about') }}</p>
                    <div class="flex space-x-4">
                        <!-- Social Icons -->
                        <!-- TikTok -->
                        <a href="https://www.tiktok.com/@alex_attorney?_r=1&_t=ZP-94nQQBPRwxL" target="_blank" class="text-gray-400 hover:text-white" title="TikTok">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.53.02C13.84 0 15.14.01 16.44 0a5.613 5.613 0 0 0 .5 3.32c1.24 1.03 2.92 1.34 4.5 1.54v3.41c-1.5-.02-3-.31-4.32-1.09-.07 3.06-.03 6.13-.07 9.19-.01 2.58-.93 5.34-3 7.02a7.35 7.35 0 0 1-9.56-.25c-2.43-2.07-3.14-5.65-1.74-8.49 1.14-2.4 3.96-3.8 6.6-3.52.01 1.25.01 2.5 0 3.75-1.42-.16-3.05.27-3.9 1.5-.96 1.16-.95 2.97-.13 4.19.86 1.45 2.82 1.96 4.3 1.27 1.22-.54 1.83-1.92 1.82-3.22-.05-4.43-.02-8.86-.03-13.3z"/>
                            </svg>
                        </a>
                        <!-- YouTube -->
                        <a href="https://youtube.com/channel/UCGmaU1ROTjPLUT7J3LN09fg?si=iADuKLQ-bB2GRZ14" target="_blank" class="text-gray-400 hover:text-white" title="YouTube">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                        <!-- WhatsApp -->
                        <a href="https://wa.me/251931307475" target="_blank" class="text-gray-400 hover:text-white" title="WhatsApp">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.112.551 4.148 1.597 5.955L.231 23.769l5.882-1.543c1.744.976 3.708 1.491 5.733 1.491 6.646 0 12.03-5.385 12.03-12.031S18.677 0 12.031 0zm6.541 17.513c-.276.776-1.595 1.464-2.193 1.543-.59.076-1.334.155-3.321-.667-2.385-.989-3.896-3.415-4.012-3.568-.112-.153-.956-1.272-.956-2.428s.604-1.724.819-1.938c.214-.214.47-.272.628-.272s.316 0 .445.006c.14.006.326-.056.51.39.183.447.625 1.53.681 1.643.056.112.093.243.018.39-.074.15-.112.244-.225.358-.112.114-.236.255-.331.341-.105.092-.218.196-.098.401.118.204.526.868 1.127 1.402.775.688 1.417.904 1.623 1.018.204.112.324.092.443-.042.12-.132.518-.601.657-.808.138-.206.275-.173.46-.103.183.07 1.155.545 1.353.645.197.098.328.15.376.233.048.083.048.483-.228 1.259z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">{{ __('site.practice_title') }}</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('practice-areas.show', 'criminal-defense') }}" class="hover:text-secondary transition">Criminal Defense</a></li>
                        <li><a href="{{ route('practice-areas.show', 'family-inheritance-law') }}" class="hover:text-secondary transition">Family & Inheritance Law</a></li>
                        <li><a href="{{ route('practice-areas.show', 'property-land-law') }}" class="hover:text-secondary transition">Property & Land Law</a></li>
                        <li><a href="{{ route('practice-areas.show', 'contract-law') }}" class="hover:text-secondary transition">Contract Law</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">{{ __('site.footer_quick_links') }}</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('about') }}" class="hover:text-secondary transition">About Us</a></li>
                        <li><a href="{{ route('attorneys.index') }}" class="hover:text-secondary transition">Our Attorneys</a></li>
                        <li><a href="{{ route('legal-forms.index') }}" class="hover:text-secondary transition">Legal Forms</a></li>
                        <li><a href="{{ route('faqs.public') }}" class="hover:text-secondary transition">FAQs</a></li>
                        <li><a href="{{ route('contact.create') }}" class="hover:text-secondary transition">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">{{ __('site.contact_title') }}</h4>
                    <ul class="space-y-2 text-sm">
                        <li>Addis Ababa, Ethiopia</li>
                        <li>Phone: +251 911 259 606</li>
                        <li>WhatsApp: +251 93 130 7475</li>
                        <li>Email: info@alebeadvocate.et</li>
                        <li>Mon - Fri: 8:00 AM - 6:00 PM</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <p>&copy; {{ date('Y') }} Alebe Advocate. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="{{ route('privacy') }}" class="hover:text-white">Privacy Policy</a>
                    <a href="{{ route('disclaimer') }}" class="hover:text-white">Legal Disclaimer</a>
                    <a href="{{ route('terms') }}" class="hover:text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Chat Widget -->
    <div id="chatWidget" class="fixed right-8 bottom-24 w-80 max-w-[calc(100vw-2rem)] bg-white dark:bg-gray-800 rounded-xl shadow-2xl z-50 hidden flex-col overflow-hidden border border-gray-200 dark:border-gray-700" aria-hidden="true">
        <div class="bg-primary text-white px-4 py-3 font-semibold flex justify-between items-center">
            <span>Live Chat</span>
            <button id="closeChat" class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
        </div>
        <div class="p-4 flex flex-col h-80">
            <div id="chatMessages" class="flex-1 overflow-y-auto mb-4 flex flex-col">
                <div class="chat-message chat-message--assistant items-start">
                    <div class="chat-bubble">Hello! We are online and ready to help.</div>
                </div>
            </div>
            
            <!-- Chat Suggestions -->
            <div id="chatSuggestions" class="flex flex-wrap gap-2 mb-3">
                <button type="button" class="chat-suggestion bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-xs px-3 py-1.5 rounded-full transition text-left shadow-sm">How much do your forms cost?</button>
                <button type="button" class="chat-suggestion bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-xs px-3 py-1.5 rounded-full transition text-left shadow-sm">How do I book a consultation?</button>
                <button type="button" class="chat-suggestion bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-xs px-3 py-1.5 rounded-full transition text-left shadow-sm">What are your office hours?</button>
            </div>

            <div class="mt-auto">
                <input id="chatName" type="hidden" value="Visitor">
                <input id="chatEmail" type="hidden" value="">
                <div class="flex gap-2">
                    <input id="chatMessage" type="text" placeholder="Type a message..." class="flex-1 px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white text-sm" autocomplete="off">
                    <button id="sendChat" class="bg-secondary text-primary px-4 py-2 rounded-lg font-bold text-sm hover:bg-yellow-400">Send</button>
                </div>
            </div>
        </div>
    </div>
    <button id="openChat" class="fixed right-8 bottom-8 w-14 h-14 bg-secondary text-primary rounded-full shadow-lg z-50 flex items-center justify-center hover:scale-110 transition-transform">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
    </button>

    <!-- Popup Notification Toast -->
    @if(session('success') || session('error'))
    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 5000)"
         x-show="show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-full"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-full"
         class="fixed top-24 right-4 z-[110] max-w-sm w-full bg-white dark:bg-gray-800 shadow-xl rounded-xl border-l-4 {{ session('error') ? 'border-red-500' : 'border-green-500' }} p-4 overflow-hidden"
         @click.away="show = false"
         x-cloak>
        <div class="flex items-start">
            <div class="flex-shrink-0">
                @if(session('success'))
                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                @else
                <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                @endif
            </div>
            <div class="ml-3 w-0 flex-1 pt-0.5">
                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ session('success') ?? session('error') }}
                </p>
            </div>
            <div class="ml-4 flex-shrink-0 flex">
                <button @click="show = false" class="bg-transparent rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @endif

    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
    
    <!-- Cookie Banner -->
    <div x-data="{ showCookieBanner: false }" 
         x-init="setTimeout(() => showCookieBanner = localStorage.getItem('cookieConsent') !== 'true', 1000)" 
         x-show="showCookieBanner" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-full"
         x-cloak 
         class="fixed bottom-0 inset-x-0 pb-2 sm:pb-5 z-[100]">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="p-2 rounded-lg bg-gray-900 shadow-lg sm:p-3 border border-gray-700">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
                        <span class="flex p-2 rounded-lg bg-gray-800">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <p class="ml-3 font-medium text-white truncate">
                            <span class="md:hidden">We use cookies to improve your experience.</span>
                            <span class="hidden md:inline">This website uses cookies to ensure you get the best experience and securely handle your sessions.</span>
                        </p>
                    </div>
                    <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                        <a href="{{ route('privacy') }}" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-primary bg-white hover:bg-gray-50 mb-2 sm:mb-0 sm:mr-2 transition">
                            Learn more
                        </a>
                    </div>
                    <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-2">
                        <button @click="localStorage.setItem('cookieConsent', 'true'); showCookieBanner = false" type="button" class="-mr-1 flex p-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-white transition">
                            <span class="sr-only">Accept cookies</span>
                            <span class="text-white font-bold px-2">Accept & Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
