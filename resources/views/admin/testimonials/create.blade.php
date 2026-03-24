@extends('layouts.app')

@section('title', 'New Testimonial')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Testimonial</h1>
        <a href="{{ route('admin.testimonials.index') }}" class="text-gray-500 hover:text-primary dark:hover:text-gray-300">&larr; Back</a>
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
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Client Name</label>
                    <input type="text" name="client_name" value="{{ old('client_name') }}" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Client Title</label>
                    <input type="text" name="client_title" value="{{ old('client_title') }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content</label>
                    <textarea name="content" rows="5" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">{{ old('content') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Rating (1-5)</label>
                    <input type="number" name="rating" min="1" max="5" value="{{ old('rating', 5) }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Photo (optional)</label>
                    <input type="file" name="photo" accept="image/*" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_video" id="is_video" value="1" {{ old('is_video') ? 'checked' : '' }} class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="is_video" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                        Video Testimonial
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Video URL (if video)</label>
                    <input type="url" name="video_url" value="{{ old('video_url') }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_approved" id="is_approved" value="1" {{ old('is_approved', true) ? 'checked' : '' }} class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="is_approved" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                        Approved (visible on homepage)
                    </label>
                </div>

                <div>
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold hover:bg-primary/90 transition w-full sm:w-auto">
                        Save Testimonial
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
