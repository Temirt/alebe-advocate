@extends('layouts.app')

@section('title', 'Our Attorneys')

@section('content')
<section class="relative py-24 bg-primary overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-20" style="background-image: url('{{ asset('images/attorney1.jpg') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/80 to-transparent z-0"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-6 tracking-tight">Our Legal Team</h1>
        <p class="text-xl text-gray-200 font-light max-w-2xl mx-auto">Experienced, dedicated professionals ready to fight for your rights.</p>
    </div>
</section>

<section class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($attorneys ?? [] as $attorney)
            <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $attorney->name }}</h3>
                <h4 class="text-gray-500 dark:text-gray-400 mb-4">{{ $attorney->title }}</h4>
                <a href="{{ route('attorneys.show', $attorney->slug) }}" class="text-primary dark:text-secondary font-semibold hover:underline">View Profile -></a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
