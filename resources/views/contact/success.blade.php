@extends('layouts.app')

@section('title', 'Success')

@section('content')
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-serif font-bold text-gray-900 mb-6">Message Sent</h1>
        <p class="text-xl text-gray-600">Your message has been sent successfully. We will be in touch shortly.</p>
        <a href="{{ route('home') }}" class="mt-8 inline-block bg-primary text-white py-2 px-6 rounded-lg">Return to Home</a>
    </div>
</section>
@endsection
