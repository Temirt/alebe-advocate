@extends('layouts.app')

@section('title', $form->title ?? 'Legal Document')

@section('content')
<section class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-50 dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="max-w-3xl mx-auto text-center">
                <span class="bg-primary/10 text-primary dark:text-secondary dark:bg-secondary/10 text-sm font-bold px-4 py-2 rounded-full uppercase tracking-wider mb-6 inline-block">Legal Document</span>
                
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 dark:text-white mb-6">
                    {{ $form->title ?? 'Legal Document' }}
                </h1>
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                    {{ $form->description ?? 'No description provided.' }}
                </p>
                
                <div class="flex flex-col sm:flex-row gap-6 mt-8 p-6 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="text-center sm:text-left sm:pr-8 sm:border-r border-gray-200 dark:border-gray-700 flex flex-col justify-center min-w-[150px]">
                        <span class="block text-sm text-gray-500 dark:text-gray-400 font-semibold mb-1">One-time Price</span>
                        <span class="text-4xl font-bold text-secondary">
                            {{ isset($form) && $form->price > 0 ? number_format($form->price, 2) . ' ETB' : 'Free' }}
                        </span>
                    </div>
                    
                    <div class="w-full flex-1 mt-4 sm:mt-0">
                        @guest
                            <div class="h-full flex flex-col items-center justify-center p-8 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                                <svg class="w-12 h-12 text-primary/50 dark:text-secondary/50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                <p class="text-center text-lg text-gray-700 dark:text-gray-200 mb-6 font-semibold">You need to create an account to pay and download.</p>
                                <div class="flex flex-col sm:flex-row gap-4 w-full justify-center">
                                    <a href="{{ route('register') }}" class="bg-primary text-white text-center py-2 px-6 rounded-lg font-bold hover:bg-primary/90 transition shadow-md">Create Account</a>
                                    <a href="{{ route('login') }}" class="bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-white text-center py-2 px-6 rounded-lg font-bold hover:bg-gray-300 dark:hover:bg-gray-600 transition shadow-md">Login</a>
                                </div>
                            </div>
                        @else
                            @if(isset($form) && $form->file_url)
                                @if($form->price > 0)
                                    <!-- Chapa Payment Form -->
                                    <form action="{{ route('checkout.pay', $form->id) }}" method="POST" class="w-full text-left space-y-4">
                                        @csrf
                                        <input type="hidden" name="guest_name" value="{{ auth()->user()->name }}">
                                        <input type="hidden" name="guest_email" value="{{ auth()->user()->email }}">
                                        
                                        <div class="mt-4">
                                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-300">Complete payment via Chapa's Secure Portal:</p>
                                        </div>
                                        <button type="submit" class="w-full text-center bg-primary text-white py-4 px-8 rounded-xl font-bold text-lg hover:bg-primary/90 transition shadow-lg inline-flex justify-center items-center mt-2 cursor-pointer">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            Pay & Download
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ $form->file_url }}" target="_blank" class="block w-full text-center bg-primary text-white py-4 px-10 rounded-xl font-bold text-lg hover:bg-primary/90 transition shadow-lg hover:shadow-xl hover:-translate-y-1 transform duration-200 h-full flex items-center justify-center">
                                        Download Now
                                    </a>
                                @endif
                            @else
                                <div class="w-full h-full bg-red-50 text-red-600 dark:bg-red-900/20 dark:text-red-400 py-4 px-10 rounded-xl font-bold text-lg flex items-center justify-center border border-red-200 dark:border-red-800">
                                    File Not Uploaded
                                </div>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
