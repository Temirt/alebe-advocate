@extends('layouts.app')

@section('title', 'Practice Areas')

@section('content')
<section class="relative py-24 bg-primary overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-20" style="background-image: url('{{ asset('images/office.jpg') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/80 to-transparent z-0"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-6 tracking-tight">Our Practice Areas</h1>
        <p class="text-xl text-gray-200 font-light max-w-2xl mx-auto">Comprehensive legal services tailored to your specific needs.</p>
    </div>
</section>

<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-200 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Bar -->
        <div class="max-w-xl mx-auto mb-16 px-4">
            <form action="{{ route('practice-areas.index') }}" method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search practice areas..." class="w-full px-6 py-4 bg-white dark:bg-gray-800 rounded-full shadow-lg border border-transparent focus:border-primary dark:focus:border-secondary outline-none transition dark:text-white">
                <button type="submit" class="absolute right-2 top-2 bg-primary text-white p-2.5 rounded-full hover:bg-primary/90 transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </form>
            @if(request('search'))
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Showing results for "<span class="font-semibold text-primary dark:text-secondary">{{ request('search') }}</span>" — <a href="{{ route('practice-areas.index') }}" class="text-accent hover:underline">Clear Search</a></p>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($practiceAreas ?? [] as $area)
            <div class="group bg-white dark:bg-gray-800 rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:border-secondary/30">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-secondary/20 transition text-primary dark:text-secondary">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-primary dark:group-hover:text-yellow-400 transition">{{ $area->title }}</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6 line-clamp-3 leading-relaxed">{{ $area->description }}</p>
                <a href="{{ route('practice-areas.show', $area->slug) }}" class="inline-flex items-center text-primary dark:text-secondary font-bold hover:gap-2 transition-all">
                    Learn More 
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-20 px-4">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full mb-6 text-gray-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No practice areas found</h3>
                <p class="text-gray-600 dark:text-gray-400">Try a different search term or browse our complete list.</p>
                <a href="{{ route('practice-areas.index') }}" class="mt-6 inline-block text-primary dark:text-secondary font-bold hover:underline">View All Areas</a>
            </div>
            @endforelse
        </div>
        
        <div class="mt-12">
            @if(isset($practiceAreas) && method_exists($practiceAreas, 'links'))
                {{ $practiceAreas->links() }}
            @endif
        </div>
    </div>
</section>
@endsection
