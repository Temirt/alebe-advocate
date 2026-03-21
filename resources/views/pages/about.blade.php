@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<section class="relative py-24 bg-primary overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-20" style="background-image: url('{{ asset('images/office.jpg') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/80 to-transparent z-0"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-6 tracking-tight">About Us</h1>
        <p class="text-xl text-gray-200 font-light max-w-2xl mx-auto">Alebe Advocate is highly experienced in the Ethiopian legal system.</p>
    </div>
</section>

<section class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose dark:prose-invert max-w-none">
            <p>Our dedicated team of professionals ensures that your legal rights are protected at all times.</p>
        </div>
    </div>
</section>
@endsection
