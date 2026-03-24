<!-- Modern Premium Navigation -->
<nav x-data="{ 
    open: false, 
    atTop: true,
    showUserMenu: false
}" 
x-init="window.addEventListener('scroll', () => { atTop = window.scrollY < 20 })"
:class="{ 'py-3 shadow-md': atTop, 'py-3 shadow-lg': !atTop }"
class="fixed top-0 w-full z-[100] transition-all duration-300 ease-out px-0"
style="background-color: #1e3a5f;">
    
    <div class="w-full">
        <div class="border border-white/10 px-4 md:px-8 h-14 flex justify-between items-center transition-all duration-300 text-white rounded-full mx-3 md:mx-6 shadow-[0_8px_24px_rgba(0,0,0,0.18)]"
             style="background-color: #1e3a5f;">
            
            <!-- Brand Logo Area -->
            <div class="flex items-center -ml-2">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="relative border border-white/15 px-2 py-1 bg-white/5 rounded-md">
                        <img src="{{ asset('images/logo-light.png') }}" class="h-7 md:h-8 w-auto logo block" data-logo-light="{{ asset('images/logo-light.png') }}" data-logo-dark="{{ asset('images/logo-dark.png') }}" alt="Alebe Advocate Logo" loading="lazy">
                    </div>
                    <div class="flex flex-col leading-snug">
                        <span class="text-white font-serif text-sm md:text-base font-extrabold tracking-tight group-hover:text-secondary transition duration-200 whitespace-nowrap">
                            {{ __('site.site_name') }}
                        </span>
                        <span class="text-secondary/80 text-[8px] uppercase font-bold tracking-[0.14em]">
                            {{ __('site.hero_subtitle') }}
                        </span>
                    </div>
                </a>
            </div>
            
            <!-- Navigation + Controls -->
            <div class="flex items-center space-x-3">
                <div class="hidden lg:flex items-center space-x-1 mr-4">
                    @php 
                        $navItems = [
                            ['route' => 'home', 'label' => 'Home'],
                            ['route' => 'practice-areas.index', 'label' => 'Practice'],
                            ['route' => 'attorneys.index', 'label' => 'Our Team'],
                            ['route' => 'legal-forms.index', 'label' => 'Forms Store'],
                            ['route' => 'contact.create', 'label' => 'Contact']
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        <a href="{{ route($item['route']) }}" 
                           class="px-3 py-1.5 text-sm font-semibold transition-all duration-200 relative group rounded-full {{ request()->routeIs($item['route']) ? 'text-secondary' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>

                <!-- Consultation CTA (desktop) -->
                <a href="{{ route('appointment.create') }}" 
                   class="hidden lg:inline-flex ml-2 bg-secondary text-primary px-5 py-2 rounded-full font-black text-xs uppercase tracking-wider hover:bg-yellow-400 transition duration-200 active:scale-[0.98]">
                    {{ __('site.hero_cta_book') }}
                </a>

                <!-- Desktop Utility Menu -->
                <div class="relative" x-data="{ openMenu: false }">
                    <button @click="window.innerWidth >= 1024 ? openMenu = !openMenu : open = !open" @click.outside="openMenu = false"
                            class="ml-2 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider border border-white/20 text-white/80 hover:text-white transition inline-flex items-center gap-2 bg-white/5 hover:bg-white/10">
                        <span>Menu</span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16"/>
                        </svg>
                    </button>
                    <div x-show="openMenu" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute right-0 mt-3 w-64 bg-[#1e3a5f] border border-white/10 shadow-2xl p-4 space-y-3 z-[110] rounded-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-white/60">Language</span>
                            <div class="flex items-center border border-white/10 p-1">
                                <a href="{{ route('language.switch', 'en') }}" class="px-3 py-1 text-[10px] font-black transition-all {{ app()->getLocale() == 'en' ? 'bg-secondary text-primary' : 'text-white/70 hover:text-white' }}">EN</a>
                                <a href="{{ route('language.switch', 'am') }}" class="px-3 py-1 text-[10px] font-black transition-all font-amharic {{ app()->getLocale() == 'am' ? 'bg-secondary text-primary' : 'text-white/70 hover:text-white' }}">አማ</a>
                            </div>
                        </div>

                        <div class="border-t border-white/10 pt-3 space-y-2">
                            @guest
                                <a href="{{ route('login') }}"
                                   class="block w-full px-3 py-2 text-xs font-bold uppercase tracking-wider text-white/80 hover:text-white border border-white/20">
                                    Login
                                </a>
                                <a href="{{ route('register') }}"
                                   class="block w-full px-3 py-2 text-xs font-bold uppercase tracking-wider bg-white text-primary hover:bg-gray-100">
                                    Create Account
                                </a>
                            @endguest
                            @auth
                                @if(auth()->user() && (auth()->user()->is_admin ?? false))
                                    <a href="{{ route('admin.dashboard') }}"
                                       class="block w-full px-3 py-2 text-xs font-bold uppercase tracking-wider text-white/80 hover:text-white border border-white/20">
                                        Admin Dashboard
                                    </a>
                                @endif
                                <a href="{{ route('profile.edit') }}"
                                   class="block w-full px-3 py-2 text-xs font-bold uppercase tracking-wider text-white/80 hover:text-white border border-white/20">
                                    My Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="block w-full px-3 py-2 text-xs font-bold uppercase tracking-wider bg-white text-primary hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            @endauth
                        </div>

                        <!-- Theme toggle moved to icon in top bar -->
                    </div>
                </div>

                <button data-theme-toggle class="hidden lg:inline-flex w-10 h-10 items-center justify-center rounded-full border border-white/20 text-white/80 hover:text-white bg-white/5 hover:bg-white/10"
                        aria-label="Toggle Theme">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

            </div>
        </div>
    </div>
    
    <!-- Mobile Fullscreen Menu -->
    <div x-show="open" 
         x-cloak 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-6"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-6"
         class="lg:hidden fixed inset-x-4 top-24 z-50 overflow-hidden">
        
        <div class="bg-primary border border-white/10 shadow-2xl overflow-hidden p-8 space-y-6">
            <div class="flex flex-col space-y-2">
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" 
                       @click="open = false" 
                       class="text-2xl font-serif font-bold py-3 px-4 transition hover:bg-white/5 {{ request()->routeIs($item['route']) ? 'text-secondary' : 'text-white/60' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
            
            <div class="pt-6 border-t border-white/10">
                <a href="{{ route('appointment.create') }}" 
                   @click="open = false"
                   class="block w-full text-center bg-secondary text-primary py-5 font-black text-lg shadow-xl active:scale-[0.98] transition">
                    {{ __('site.hero_cta_book') }}
                </a>
            </div>

            <div class="pt-6 border-t border-white/10 space-y-3">
                @guest
                    <a href="{{ route('login') }}"
                       @click="open = false"
                       class="block w-full text-center border border-white/20 text-white py-4 font-black text-lg transition hover:bg-white/5">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       @click="open = false"
                       class="block w-full text-center bg-white text-primary py-4 font-black text-lg transition hover:bg-gray-100">
                        Create Account
                    </a>
                @endguest
                @auth
                    <a href="{{ route('profile.edit') }}"
                       @click="open = false"
                       class="block w-full text-center border border-white/20 text-white py-4 font-black text-lg transition hover:bg-white/5">
                        My Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="block w-full text-center bg-white text-primary py-4 font-black text-lg transition hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>

            <div class="pt-6 border-t border-white/10">
                <div class="text-[10px] font-bold uppercase tracking-wider text-white/60 mb-3">Language</div>
                <div class="flex items-center border border-white/10 p-1 w-fit">
                    <a href="{{ route('language.switch', 'en') }}" class="px-3 py-1 text-[10px] font-black transition-all {{ app()->getLocale() == 'en' ? 'bg-secondary text-primary' : 'text-white/70 hover:text-white' }}">EN</a>
                    <a href="{{ route('language.switch', 'am') }}" class="px-3 py-1 text-[10px] font-black transition-all font-amharic {{ app()->getLocale() == 'am' ? 'bg-secondary text-primary' : 'text-white/70 hover:text-white' }}">አማ</a>
                </div>
            </div>
        </div>
    </div>
</nav>




