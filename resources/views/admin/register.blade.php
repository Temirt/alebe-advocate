@extends('layouts.app')

@section('title', 'Create Account')

@section('content')
<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-200 min-h-screen flex flex-col justify-center">
    <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-serif font-bold text-gray-900 dark:text-white mb-2">Create Account</h1>
            <p class="text-gray-600 dark:text-gray-300">Join us to manage your legal needs</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-8">
            @if($errors->any())
                <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 mb-6 rounded-md">
                    <ul class="text-red-700 dark:text-red-400 text-sm font-medium space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                    <input type="text" name="name" id="name" required class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent transition" value="{{ old('name') }}">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent transition" value="{{ old('email') }}">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" id="password" required class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent transition">
                    </div>
                </div>

                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-primary dark:text-secondary hover:underline transition">Already have an account?</a>
                    <button type="submit" class="bg-primary text-white py-3 px-8 rounded-lg font-bold text-base hover:bg-primary/90 dark:bg-secondary dark:text-primary dark:hover:bg-yellow-400 transition shadow-lg">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
