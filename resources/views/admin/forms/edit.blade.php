@extends('layouts.app')

@section('title', 'Edit Form')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Form</h1>
        <a href="{{ route('admin.forms.index') }}" class="text-gray-500 hover:text-primary dark:hover:text-gray-300">&larr; Back</a>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
            <strong>Please fix the following issues:</strong>
            <ul class="list-disc ml-5 mt-2">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
        <form action="{{ route('admin.forms.update', $form->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title', $form->title) }}" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">{{ old('description', $form->description) }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price (optional, USD)</label>
                <input type="text" name="price" value="{{ old('price', $form->price) }}" placeholder="0.00" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Attach new file (optional, replaces old one)</label>
                <input type="file" name="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/90 dark:text-gray-300">
                @if($form->file_url)
                    <p class="mt-2 text-sm text-gray-500">Current file: <a href="{{ $form->file_url }}" target="_blank" class="text-blue-500 underline">View</a></p>
                @endif
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $form->is_published) ? 'checked' : '' }} class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                <label for="is_published" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                    Published (visible on main site)
                </label>
            </div>

            <div>
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold hover:bg-primary/90 transition w-full sm:w-auto">
                    Update Form
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
