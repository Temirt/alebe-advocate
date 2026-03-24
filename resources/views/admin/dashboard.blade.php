@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8 dark:text-white">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">Total Forms</h3>
            <p class="text-3xl font-bold text-primary dark:text-white mt-2">{{ $formsCount }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">Total Orders</h3>
            <p class="text-3xl font-bold text-primary dark:text-white mt-2">{{ $ordersCount ?? 0 }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">Total Users</h3>
            <p class="text-3xl font-bold text-primary dark:text-white mt-2">{{ $usersCount }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">Contact Submissions</h3>
            <p class="text-3xl font-bold text-primary dark:text-white mt-2">{{ $messagesCount }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">Live Chats</h3>
            <p class="text-3xl font-bold text-primary dark:text-white mt-2">{{ $liveChatsCount ?? 0 }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">Total FAQs</h3>
            <p class="text-3xl font-bold text-primary dark:text-white mt-2">{{ $faqsCount }}</p>
        </div>
    </div>

    <div class="flex flex-wrap gap-4">
        <a href="{{ route('admin.orders.index') }}" class="bg-secondary text-primary px-6 py-3 rounded-lg font-bold hover:bg-yellow-400 transition text-center flex-1 sm:flex-none">
            Manage Orders
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary/90 transition text-center flex-1 sm:flex-none">
            Manage Contacts
        </a>
        <a href="{{ route('admin.forms.index') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary/90 transition text-center flex-1 sm:flex-none">
            Manage Forms
        </a>
        <a href="{{ route('admin.attorneys.index') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary/90 transition text-center flex-1 sm:flex-none">
            Manage Legal Team
        </a>
        <a href="{{ route('admin.faqs.index') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary/90 transition text-center flex-1 sm:flex-none">
            Manage FAQs
        </a>
        <a href="{{ route('admin.case-results.index') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary/90 transition text-center flex-1 sm:flex-none">
            Manage Case Results
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary/90 transition text-center flex-1 sm:flex-none">
            Manage Testimonials
        </a>
        <a href="{{ route('admin.chat.index') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary/90 transition text-center flex-1 sm:flex-none">
            View Chat Messages
        </a>
        <form method="POST" action="{{ route('logout') }}" class="flex-1 sm:flex-none flex">
            @csrf
            <button type="submit" class="w-full bg-red-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-12">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-4">Recent Login Activity</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 dark:text-gray-400">
                            <th class="py-2">Event</th>
                            <th class="py-2">User</th>
                            <th class="py-2">IP</th>
                            <th class="py-2">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loginLogs as $log)
                            <tr class="border-t border-gray-100 dark:border-gray-700">
                                <td class="py-2 font-medium text-gray-900 dark:text-white">{{ $log->event_type }}</td>
                                <td class="py-2 text-gray-600 dark:text-gray-300">
                                    {{ $log->user?->email ?? (data_get($log->metadata, 'email') ?? 'Guest') }}
                                </td>
                                <td class="py-2 text-gray-600 dark:text-gray-300">{{ $log->ip_address }}</td>
                                <td class="py-2 text-gray-500 dark:text-gray-400">{{ $log->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-2 text-gray-500 dark:text-gray-400" colspan="4">No login activity yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-4">Recent Payments & Downloads</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 dark:text-gray-400">
                            <th class="py-2">Event</th>
                            <th class="py-2">Order</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paymentLogs as $log)
                            <tr class="border-t border-gray-100 dark:border-gray-700">
                                <td class="py-2 font-medium text-gray-900 dark:text-white">{{ $log->event_type }}</td>
                                <td class="py-2 text-gray-600 dark:text-gray-300">
                                    {{ data_get($log->metadata, 'order_id') ?? '—' }}
                                </td>
                                <td class="py-2 text-gray-600 dark:text-gray-300">{{ $log->status }}</td>
                                <td class="py-2 text-gray-500 dark:text-gray-400">{{ $log->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-2 text-gray-500 dark:text-gray-400" colspan="4">No payment activity yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
