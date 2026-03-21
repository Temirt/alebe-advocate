@extends('layouts.app')

@section('title', $attorney->name ?? 'Attorney')

@section('content')
<section class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-serif font-bold text-gray-900 dark:text-white mb-2">{{ $attorney->name ?? '' }}</h1>
        <h2 class="text-xl mb-6 text-gray-500 dark:text-gray-400">{{ $attorney->title ?? '' }}</h2>
        <p class="text-lg text-gray-700 dark:text-gray-300">{{ $attorney->bio ?? '' }}</p>
    </div>
</section>
@endsection
