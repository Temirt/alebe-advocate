@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-200 min-h-screen flex flex-col justify-center">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-serif font-bold text-gray-900 dark:text-white mb-2">Welcome Back</h1>
            <p class="text-gray-600 dark:text-gray-300">Sign in to your account</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-8">
            @if($errors->any())
                <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 mb-6 rounded-md">
                    <p class="text-red-700 dark:text-red-400 text-sm font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent transition" placeholder="you@example.com" value="{{ old('email') }}">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent transition" placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('register') }}" class="text-sm font-medium text-primary dark:text-secondary hover:underline transition">Create an account</a>
                    <button type="submit" class="bg-primary text-white py-3 px-8 rounded-lg font-bold text-base hover:bg-primary/90 dark:bg-secondary dark:text-primary dark:hover:bg-yellow-400 transition shadow-lg">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
