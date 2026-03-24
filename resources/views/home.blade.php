@extends('layouts.app')

@section('title', 'Home')
@section('meta_description', 'Alebe Advocate - Serious Defense for Serious Charges. Expert legal representation in Ethiopia.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-primary min-h-[600px] flex items-center bg-cover bg-center pt-20" style="background-image: url('{{ asset('images/hero-law.jpg') }}');">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary/90 via-primary/80 to-transparent"></div>
        <!-- Abstract pattern -->
        <svg class="absolute right-0 top-0 h-full w-1/2 opacity-10" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 0 L100 0 L100 100 Z" fill="white"/>
        </svg>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="max-w-3xl">
            <div class="inline-block bg-secondary/20 text-secondary px-4 py-2 rounded-full text-sm font-semibold mb-6">
                Trusted Legal Representation in Ethiopia
            </div>
            <h1 class="text-5xl md:text-6xl font-serif font-bold text-white leading-tight mb-6">
                {{ __('site.hero_headline') }}<br>
                <span class="text-secondary">{{ __('site.hero_headline_em') }}</span>
            </h1>
            <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                {{ __('site.hero_lead') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('appointment.create') }}" class="bg-secondary text-primary px-8 py-4 rounded-full font-bold text-center hover:bg-yellow-400 transition transform hover:scale-105">
                    {{ __('site.hero_cta_book') }}
                </a>
                <a href="{{ route('practice-areas.index') }}" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-center hover:bg-white hover:text-primary transition">
                    {{ __('site.footer_quick_links') }}
                </a>
            </div>
            
            <!-- Trust Badges -->
            <div class="mt-12 flex flex-wrap items-center gap-8 opacity-80">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-secondary" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span class="text-white font-semibold">Ethiopian Bar Association</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-secondary" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span class="text-white font-semibold">5-Star Rated</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Practice Areas Section -->
<section class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-bold text-gray-900 dark:text-white mb-4">{{ __('site.practice_title') }}</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">{{ __('site.practice_sub') }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($practiceAreas as $area)
            <div class="group bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:border-secondary/30">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-secondary/20 transition">
                    <svg class="w-7 h-7 text-primary dark:text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ $area->title }}</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">{{ $area->description }}</p>
                <a href="{{ route('practice-areas.show', $area->slug) }}" class="inline-flex items-center text-primary dark:text-secondary font-semibold hover:text-secondary dark:hover:text-yellow-400 transition">
                    Learn More 
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('practice-areas.index') }}" class="inline-flex items-center bg-primary text-white px-8 py-3 rounded-full font-semibold hover:bg-primary/90 dark:hover:bg-primary/80 transition">
                View All Practice Areas
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-secondary dark:bg-gray-800 transition-colors duration-200 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl md:text-5xl font-serif font-bold text-primary dark:text-secondary mb-2">500+</div>
                <div class="text-primary/80 dark:text-gray-300 font-medium">Cases Won</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-serif font-bold text-primary dark:text-secondary mb-2">15+</div>
                <div class="text-primary/80 dark:text-gray-300 font-medium">Years Experience</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-serif font-bold text-primary dark:text-secondary mb-2">250+</div>
                <div class="text-primary/80 dark:text-gray-300 font-medium">Legal Forms</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-serif font-bold text-primary dark:text-secondary mb-2">98%</div>
                <div class="text-primary/80 dark:text-gray-300 font-medium">Client Satisfaction</div>
            </div>
        </div>
    </div>
</section>

<!-- Attorneys Section -->
<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-bold text-gray-900 dark:text-white mb-4">Our Legal Team</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Experienced attorneys dedicated to achieving the best outcomes for our clients</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($attorneys as $attorney)
            <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg border border-transparent dark:border-gray-700 hover:shadow-2xl transition group">
                <div class="relative h-80 overflow-hidden">
                    @if($attorney->photo)
                        <img src="{{ asset('storage/' . $attorney->photo) }}" alt="{{ $attorney->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <svg class="w-20 h-20 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                        <a href="{{ route('attorneys.show', $attorney->slug) }}" class="text-white font-semibold hover:text-secondary transition">View Profile →</a>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">{{ $attorney->name }}</h3>
                    <p class="text-secondary font-medium mb-3">{{ $attorney->title }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2">{{ Str::limit($attorney->bio, 100) }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('attorneys.index') }}" class="inline-flex items-center border-2 border-primary text-primary px-8 py-3 rounded-full font-semibold hover:bg-primary hover:text-white dark:border-secondary dark:text-secondary dark:hover:bg-secondary dark:hover:text-primary transition">
                Meet Our Full Team
            </a>
        </div>
    </div>
</section>

<!-- Case Results Section -->
<section class="py-20 bg-primary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-bold mb-4">Proven Results</h2>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">Track record of successful outcomes for our clients</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredCases as $case)
            <div class="bg-white/10 backdrop-blur rounded-2xl p-8 border border-white/20 hover:bg-white/20 transition">
                <div class="text-secondary font-bold text-sm uppercase tracking-wider mb-2">{{ $case->practice_area }}</div>
                <h3 class="text-xl font-bold mb-3">{{ $case->title }}</h3>
                <p class="text-gray-300 mb-4">{{ Str::limit($case->description, 120) }}</p>
                <div class="flex items-center text-secondary font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ $case->result_type }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-bold text-gray-900 dark:text-white mb-4">Client Testimonials</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300">What our clients say about our services</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 relative border border-transparent dark:border-gray-700">
                <svg class="absolute top-6 right-6 w-10 h-10 text-secondary/30" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                <div class="flex items-center mb-4">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                        <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-gray-700 dark:text-gray-300 mb-6 italic">"{{ $testimonial->content }}"</p>
                <div class="flex items-center">
                    @if($testimonial->photo)
                        <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->client_name }}" class="w-12 h-12 rounded-full object-cover mr-4 border border-gray-200 dark:border-gray-600">
                    @else
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white font-bold mr-4">
                            {{ substr($testimonial->client_name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <div class="font-bold text-gray-900 dark:text-white">{{ $testimonial->client_name }}</div>
                        @if($testimonial->client_title)
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $testimonial->client_title }}</div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 relative bg-cover bg-center text-white" style="background-image: url('{{ asset('images/office.jpg') }}');">
    <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary/90 to-primary/80"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">Ready to Discuss Your Case?</h2>
        <p class="text-xl text-gray-300 mb-8 w-full">Schedule a free consultation today. We are here to help you navigate through your legal challenges.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('appointment.create') }}" class="bg-secondary text-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-yellow-400 transition transform hover:scale-105">
                Schedule Consultation
            </a>
            <a href="tel:+251911259606" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-primary transition flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                Call: +251 911 259 606
            </a>
        </div>
    </div>
</section>
@endsection
