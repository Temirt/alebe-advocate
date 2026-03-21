<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Alebe Advocate')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

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
                        serif: ['Merriweather', 'serif'],
                        sans: ['Poppins', 'sans-serif'],
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
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        [x-cloak] { display: none !important; }
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
</head>
<body>

@include('partials.navbar')

<!-- MAIN CONTENT -->
<main class="main-content public">
    @yield('content')
</main>

<script src="{{ asset('assets/js/main.js') }}"></script>
<!-- Chat widget toggle + panel -->
<button id="openChat" class="chat-btn" title="Live chat">
    <i class="fas fa-comments"></i>
</button>
<div id="chatWidget" class="chat-widget" aria-hidden="true">
    <div class="chat-header">
        <strong>Live Chat</strong>
        <button id="closeChat" style="background:none;border:none;">×</button>
    </div>
    <div class="chat-body">
        <div id="chatMessages" class="chat-messages">
            <div class="chat-message chat-message--assistant">
                <div class="chat-bubble">Hello! We are online and ready to help.</div>
            </div>
        </div>
        <input id="chatName" placeholder="Your name (optional)">
        <input id="chatEmail" placeholder="Email (optional)">
        <textarea id="chatMessage" placeholder="Type your message"></textarea>
        <div style="text-align:right;"><button id="sendChat" class="btn">Send</button></div>
    </div>
</div>
</body>
</html>
