@extends('layouts.app')

@section('title', 'Manage FAQs')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Manage FAQs</h1>
        <a href="{{ route('admin.faqs.create') }}" class="bg-secondary text-primary px-6 py-2 rounded-lg font-bold hover:bg-yellow-400 transition">New FAQ</a>
    </div>

    @if(session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden border border-gray-100 dark:border-gray-700">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-900 border-b dark:border-gray-700">
                    <th class="py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Question</th>
                    <th class="py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Rating</th>
                    <th class="py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Published</th>
                    <th class="py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $f)
                    <tr class="border-b dark:border-gray-700 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="py-4 px-6">{{ $f->question }}</td>
                        <td class="py-4 px-6">{{ $f->rating ?? 0 }}</td>
                        <td class="py-4 px-6">
                            @if($f->is_published)
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">Yes</span>
                            @else
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full font-semibold">No</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 space-x-3">
                            <a href="{{ route('admin.faqs.edit', $f) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Edit</a>
                            <form action="{{ route('admin.faqs.destroy', $f) }}" method="POST" class="inline" onsubmit="return confirm('Delete FAQ?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 inline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $faqs->links() }}
    </div>
</div>
@endsection
