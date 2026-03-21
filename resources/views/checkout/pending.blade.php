@extends('layouts.app')

@section('title', 'Complete Payment')

@section('content')
<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-200 min-h-[60vh] flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-lg border border-gray-100 dark:border-gray-700">
            <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-yellow-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            </div>
            
            <h1 class="text-3xl font-serif font-bold text-gray-900 dark:text-white mb-4">
                Please Check Your Phone!
            </h1>
            
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                A Telebirr payment prompt has been sent to <span class="font-bold text-primary dark:text-secondary">{{ $order->guest_phone }}</span>. 
                Please enter your PIN on your mobile device to authorize the payment.
            </p>

            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 mb-8 text-left max-w-sm mx-auto shadow-inner border border-gray-200 dark:border-gray-600">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-500 dark:text-gray-400">Total Amount:</span>
                    <span class="font-bold text-secondary">{{ number_format($order->amount, 2) }} ETB</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Transaction ID:</span>
                    <span class="font-medium text-gray-900 dark:text-white text-sm">{{ $tx_ref }}</span>
                </div>
            </div>
            
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 font-medium">Once you have successfully entered your PIN and confirmed on your phone, click the button below to verify the purchase.</p>
            
            <a href="{{ route('checkout.callback', ['tx_ref' => $tx_ref]) }}" class="inline-flex items-center justify-center bg-primary text-white py-4 px-8 rounded-xl font-bold text-lg hover:bg-primary/90 transition shadow-lg w-full sm:w-auto">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                I Have Paid
            </a>
            
            <div class="mt-8 text-sm">
                <a href="{{ route('legal-forms.index') }}" class="text-gray-400 hover:text-primary dark:hover:text-white transition underline">Cancel and return to Forms Store</a>
            </div>
        </div>
    </div>
</section>
@endsection
