@extends('layouts.app')

@section('title', 'Book Free Consultation')
@section('meta_description', 'Schedule a free legal consultation with Alebe Advocate. Available for criminal, family, property, and contract law matters.')

@section('content')
<section class="bg-primary py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-6">Book Your Free Consultation</h1>
        <p class="text-xl text-gray-300">Take the first step toward resolving your legal matter. No obligation, confidential discussion.</p>
    </div>
</section>

<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-200 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-8 md:p-12">
            <form action="{{ route('appointment.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name *</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent" value="{{ old('name') }}">
                        @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number *</label>
                        <input type="tel" name="phone" required class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent" value="{{ old('phone') }}">
                        @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address *</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent" value="{{ old('email') }}">
                    @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Practice Area *</label>
                    <select name="practice_area" required class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent">
                        <option value="">Select practice area</option>
                        @foreach($practiceAreas ?? [] as $area)
                            <option value="{{ $area }}" {{ old('practice_area') == $area ? 'selected' : '' }}>{{ $area }}</option>
                        @endforeach
                    </select>
                    @error('practice_area')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Preferred Date *</label>
                        <input type="date" name="preferred_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent" value="{{ old('preferred_date') }}">
                        @error('preferred_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Preferred Time *</label>
                        <select name="preferred_time" required class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent">
                            <option value="">Select time</option>
                            <option value="09:00" {{ old('preferred_time') == '09:00' ? 'selected' : '' }}>9:00 AM</option>
                            <option value="10:00" {{ old('preferred_time') == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                            <option value="11:00" {{ old('preferred_time') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                            <option value="14:00" {{ old('preferred_time') == '14:00' ? 'selected' : '' }}>2:00 PM</option>
                            <option value="15:00" {{ old('preferred_time') == '15:00' ? 'selected' : '' }}>3:00 PM</option>
                            <option value="16:00" {{ old('preferred_time') == '16:00' ? 'selected' : '' }}>4:00 PM</option>
                        </select>
                        @error('preferred_time')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Additional Notes</label>
                    <textarea name="notes" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent" placeholder="Briefly describe your legal matter...">{{ old('notes') }}</textarea>
                </div>
                
                <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-700/50 rounded-lg p-4">
                    <p class="text-sm text-yellow-800 dark:text-yellow-200 flex items-start">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        <span>By submitting this form, you acknowledge that no attorney-client relationship is formed until a formal engagement agreement is signed.</span>
                    </p>
                </div>
                
                <button type="submit" class="w-full bg-secondary text-primary py-4 rounded-lg font-bold text-lg hover:bg-yellow-400 transition transform hover:scale-[1.02] shadow-lg">
                    Request Appointment
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
