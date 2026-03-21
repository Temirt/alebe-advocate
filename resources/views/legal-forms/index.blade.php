@extends('layouts.app')

@section('title', 'Legal Forms Store')
@section('meta_description', 'Download professional legal forms for Ethiopian law. Contracts, court applications, and legal documents.')

@section('content')
<section class="relative py-24 bg-primary overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-20" style="background-image: url('{{ asset('images/office.jpg') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/80 to-transparent z-0"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-6 tracking-tight">Legal Forms Store</h1>
        <p class="text-xl text-gray-200 font-light max-w-2xl mx-auto">Professional legal forms and templates for self-representation. Save time and money with our expertly crafted documents.</p>
    </div>
</section>

<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-200 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Bar -->
        <div class="max-w-xl mx-auto mb-16">
            <form action="{{ route('legal-forms.index') }}" method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for contracts, applications, agreements..." class="w-full px-6 py-4 bg-white dark:bg-gray-800 rounded-full shadow-lg border border-transparent focus:border-primary dark:focus:border-secondary outline-none transition dark:text-white">
                <button type="submit" class="absolute right-2 top-2 bg-primary text-white p-2.5 rounded-full hover:bg-primary/90 transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </form>
            @if(request('search'))
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Showing results for "<span class="font-semibold text-primary dark:text-secondary">{{ request('search') }}</span>" — <a href="{{ route('legal-forms.index') }}" class="text-accent hover:underline">Clear Search</a></p>
                </div>
            @endif
        </div>

        <!-- Categories -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="px-6 py-2 bg-primary text-white rounded-full font-medium">Available Legal Documents ({{ $forms->total() }})</button>
        </div>

        <!-- Forms Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($forms as $form)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-transparent dark:border-gray-700 overflow-hidden hover:shadow-2xl transition group">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-primary/10 text-primary dark:text-secondary dark:bg-secondary/10 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Document</span>
                        <span class="text-2xl font-bold text-secondary">${{ number_format($form->price, 2) }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary dark:group-hover:text-yellow-400 transition">{{ $form->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">{{ $form->description ?? 'Professional legal template for Ethiopian law.' }}</p>
                    <a href="{{ route('legal-forms.show', $form) }}" class="block w-full text-center bg-primary text-white py-3 rounded-lg font-semibold hover:bg-primary/90 transition">
                        View Details
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No forms found</h3>
                <p class="text-gray-600 dark:text-gray-400">Try adjusting your search terms or browse our categories.</p>
                <a href="{{ route('legal-forms.index') }}" class="mt-6 inline-block text-primary dark:text-secondary font-bold hover:underline">Clear all filters</a>
            </div>
            @endforelse
        </div>
        
        <div class="mt-12">
            @if(method_exists($forms, 'links'))
                {{ $forms->links() }}
            @endif
        </div>
    </div>
</section>
@endsection
