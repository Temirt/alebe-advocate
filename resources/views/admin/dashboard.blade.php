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
        <a href="{{ route('admin.faqs.index') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary/90 transition text-center flex-1 sm:flex-none">
            Manage FAQs
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
</div>
@endsection
