@extends('layouts.app')

@section('title', 'Payment Success')

@section('content')
<section class="py-20 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 min-h-[60vh] flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-8" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-lg border border-gray-100 dark:border-gray-700">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            
            <h1 class="text-4xl font-serif font-bold text-gray-900 dark:text-white mb-4">
                Thank you, {{ $order->guest_name ?? 'Customer' }}!
            </h1>
            
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                Your payment for <span class="font-bold">"{{ $order->form->title }}"</span> has been confirmed.
            </p>

            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 mb-8 text-left max-w-sm mx-auto">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-500 dark:text-gray-400">Order ID:</span>
                    <span class="font-medium text-gray-900 dark:text-white">#{{ $order->id }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-500 dark:text-gray-400">Transaction Ref:</span>
                    <span class="font-medium text-gray-900 dark:text-white">{{ $order->transaction_id }}</span>
                </div>
                <div class="flex justify-between font-bold mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                    <span class="text-gray-700 dark:text-gray-300">Total Paid:</span>
                    <span class="text-secondary">${{ number_format($order->amount, 2) }}</span>
                </div>
            </div>
            
            @if(($order->download_count ?? 0) < 1)
                <a href="{{ route('checkout.download', $order->id) }}" class="inline-flex items-center justify-center bg-primary text-white py-4 px-8 rounded-xl font-bold text-lg hover:bg-primary/90 transition shadow-lg w-full sm:w-auto">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Download Document
                </a>
            @else
                <div class="inline-flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-300 py-4 px-8 rounded-xl font-bold text-lg w-full sm:w-auto">
                    Download Used
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-3">This order allows only one download.</p>
            @endif
            
            <div class="mt-6">
                <a href="{{ route('legal-forms.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-white transition">
                    &larr; Back to Forms
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
