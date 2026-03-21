@extends('layouts.app')

@section('title', 'Contact Messages')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Contact Submissions</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
                        <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-sm uppercase">Date</th>
                        <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-sm uppercase">Sender</th>
                        <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-sm uppercase">Practice Area</th>
                        <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-sm uppercase">Subject & Message</th>
                        <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-sm uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($contacts as $contact)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition">
                            <td class="py-4 px-6 text-gray-800 dark:text-gray-200 whitespace-nowrap align-top">
                                {{ $contact->created_at->format('M d, Y') }}<br>
                                <span class="text-xs text-gray-500">{{ $contact->created_at->format('h:i A') }}</span>
                            </td>
                            <td class="py-4 px-6 text-gray-800 dark:text-gray-200 align-top">
                                <div class="font-bold">{{ $contact->name }}</div>
                                <div class="text-sm">
                                    <a href="mailto:{{ $contact->email }}" class="text-primary dark:text-secondary hover:underline">{{ $contact->email }}</a>
                                </div>
                                @if($contact->phone)
                                    <div class="text-sm text-gray-500">{{ $contact->phone }}</div>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-gray-800 dark:text-gray-200 align-top">
                                @if($contact->practice_area)
                                    <span class="bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 text-xs font-medium px-2.5 py-0.5 rounded">{{ $contact->practice_area }}</span>
                                @else
                                    <span class="text-gray-400 italic">None</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-gray-800 dark:text-gray-200 align-top max-w-md">
                                <div class="font-bold mb-1">{{ $contact->subject }}</div>
                                <div class="text-sm whitespace-pre-wrap">{{ $contact->message }}</div>
                            </td>
                            <td class="py-4 px-6 align-top">
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 dark:bg-red-900/20 px-3 py-1.5 rounded-lg text-sm transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 px-6 text-center text-gray-500 dark:text-gray-400">
                                No contact messages found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($contacts->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
