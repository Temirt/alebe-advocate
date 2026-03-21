<!-- Navigation -->
<nav x-data="{ open: false }" class="bg-primary shadow-lg fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo-light.png') }}" class="h-10 w-auto logo" data-logo-light="{{ asset('images/logo-light.png') }}" data-logo-dark="{{ asset('images/logo-dark.png') }}" alt="Alebe Advocate Logo">
                    <div class="flex flex-col leading-tight">
                        <span class="text-white font-serif text-lg md:text-xl font-bold">Alebe Advocate</span>
                        <span class="text-gray-300 text-[10px] md:text-xs uppercase tracking-wider mt-0.5">Legal Services</span>
                    </div>
                </a>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6 flex-nowrap whitespace-nowrap">
                @if(request()->is('admin*'))
                    <a href="{{ route('admin.dashboard') }}" class="text-secondary hover:text-yellow-400 font-bold transition">Dashboard</a>
                    <a href="{{ route('admin.orders.index') }}" class="text-gray-300 hover:text-white transition">Orders</a>
                    <a href="{{ route('admin.contacts.index') }}" class="text-gray-300 hover:text-white transition">Contacts</a>
                    <a href="{{ route('admin.forms.index') }}" class="text-gray-300 hover:text-white transition">Forms</a>
                    <a href="{{ route('admin.faqs.index') }}" class="text-gray-300 hover:text-white transition">FAQs</a>
                    <a href="{{ route('admin.chat.index') }}" class="text-gray-300 hover:text-white transition">Live Chats</a>
                    @auth
                        <div x-data="{ openUser: false }" class="relative">
                            <button type="button" @click="openUser = !openUser" class="flex items-center gap-2 text-gray-300 hover:text-white transition">
                                @if(auth()->user()->profile_photo_path)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Profile" class="h-9 w-9 rounded-full object-cover border border-gray-600">
                                @else
                                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-gray-700 text-white text-sm font-semibold">
                                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                    </span>
                                @endif
                                <span class="hidden lg:inline text-sm">
                                    {{ auth()->user()->name ?? 'User' }}
                                </span>
                                <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="openUser" x-cloak @click.away="openUser = false" x-transition class="absolute right-0 mt-2 w-56 rounded-lg bg-white shadow-xl ring-1 ring-black/10 py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <div class="text-sm font-semibold text-gray-900">{{ auth()->user()->name ?? 'User' }}</div>
                                    <div class="text-xs text-gray-500">{{ auth()->user()->is_admin ? 'Admin' : 'Client' }}</div>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">My Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                @else
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition">Home</a>
                    <a href="{{ route('practice-areas.index') }}" class="text-gray-300 hover:text-white transition">Practice Areas</a>
                    <a href="{{ route('attorneys.index') }}" class="text-gray-300 hover:text-white transition">Our Team</a>
                    <a href="{{ route('legal-forms.index') }}" class="text-gray-300 hover:text-white transition">Legal Forms</a>
                    <a href="{{ route('contact.create') }}" class="text-gray-300 hover:text-white transition">Contact</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-300 hover:text-white transition font-medium">Create Account</a>
                    @endguest
                    @auth
                        <div x-data="{ openUser: false }" class="relative">
                            <button type="button" @click="openUser = !openUser" class="flex items-center gap-2 text-gray-300 hover:text-white transition">
                                @if(auth()->user()->profile_photo_path)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Profile" class="h-9 w-9 rounded-full object-cover border border-gray-600">
                                @else
                                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-gray-700 text-white text-sm font-semibold">
                                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                    </span>
                                @endif
                                <span class="hidden lg:inline text-sm">
                                    {{ auth()->user()->name ?? 'User' }}
                                </span>
                                <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="openUser" x-cloak @click.away="openUser = false" x-transition class="absolute right-0 mt-2 w-56 rounded-lg bg-white shadow-xl ring-1 ring-black/10 py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <div class="text-sm font-semibold text-gray-900">{{ auth()->user()->name ?? 'User' }}</div>
                                    <div class="text-xs text-gray-500">{{ auth()->user()->is_admin ? 'Admin' : 'Client' }}</div>
                                </div>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Admin Dashboard</a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">My Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                    <a href="{{ route('appointment.create') }}" class="bg-secondary text-primary px-6 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">
                        Free Consultation
                    </a>
                @endif
                <button id="themeToggle" class="text-gray-300 hover:text-white" title="Toggle Dark Mode">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                </button>
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="text-gray-300 hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div x-show="open" x-cloak class="md:hidden bg-primary border-t border-gray-700">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @if(request()->is('admin*'))
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-secondary hover:text-white font-bold">Dashboard</a>
                <a href="{{ route('admin.orders.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Orders</a>
                <a href="{{ route('admin.contacts.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Contacts</a>
                <a href="{{ route('admin.forms.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Forms</a>
                <a href="{{ route('admin.faqs.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white">FAQs</a>
                <a href="{{ route('admin.chat.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Live Chats</a>
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-gray-300 hover:text-white">My Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 text-gray-300 hover:text-white">Logout</button>
                </form>
            @else
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Home</a>
                <a href="{{ route('practice-areas.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Practice Areas</a>
                <a href="{{ route('attorneys.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Our Team</a>
                <a href="{{ route('legal-forms.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Legal Forms</a>
                <a href="{{ route('contact.create') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Contact</a>
                @guest
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Login</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Create Account</a>
                @endguest
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-secondary hover:text-white font-bold">Admin Dashboard</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-gray-300 hover:text-white">My Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 text-gray-300 hover:text-white">Logout</button>
                    </form>
                @endauth
                <a href="{{ route('appointment.create') }}" class="block px-3 py-2 text-gray-300 hover:text-white">Free Consultation</a>
            @endif
        </div>
    </div>
</nav>
