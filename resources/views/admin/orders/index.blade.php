@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Order Management</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
                        <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-sm uppercase tracking-wider">Date</th>
                        <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-sm uppercase tracking-wider">Transaction ID</th>
                        <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-sm uppercase tracking-wider">Customer</th>
                        <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-sm uppercase tracking-wider">Form</th>
                        <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-sm uppercase tracking-wider">Amount</th>
                        <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-sm uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition">
                            <td class="py-4 px-6 text-gray-800 dark:text-gray-200 whitespace-nowrap">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                            <td class="py-4 px-6 text-gray-800 dark:text-gray-200"><span class="font-mono text-xs">{{ $order->transaction_id }}</span></td>
                            <td class="py-4 px-6 text-gray-800 dark:text-gray-200">
                                <div class="font-medium">{{ $order->guest_name }}</div>
                                <div class="text-xs text-gray-500">{{ $order->guest_email }}</div>
                                <div class="text-xs text-gray-500">{{ $order->guest_phone }}</div>
                            </td>
                            <td class="py-4 px-6 text-gray-800 dark:text-gray-200">
                                @if($order->form)
                                    <a href="{{ route('legal-forms.show', $order->form_id) }}" class="text-primary dark:text-secondary hover:underline" target="_blank">{{ $order->form->title }}</a>
                                @else
                                    <span class="text-gray-500 italic">Deleted Form</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-gray-800 dark:text-gray-200 font-bold">{{ number_format($order->amount, 2) }} ETB</td>
                            <td class="py-4 px-6">
                                @if($order->status == 'completed')
                                    <span class="bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 text-xs font-bold px-3 py-1 rounded-full uppercase">Completed</span>
                                @elseif($order->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300 text-xs font-bold px-3 py-1 rounded-full uppercase">Pending</span>
                                @else
                                    <span class="bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 text-xs font-bold px-3 py-1 rounded-full uppercase">{{ $order->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 px-6 text-center text-gray-500 dark:text-gray-400">
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
