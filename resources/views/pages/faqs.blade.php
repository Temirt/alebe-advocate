@extends('layouts.app')

@section('title', 'Frequently Asked Questions')

@section('content')
<section class="relative py-24 bg-primary overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary/90 to-secondary/20 z-0"></div>
    <div class="absolute inset-0 opacity-10 bg-gradient-to-br from-white/10 to-transparent z-0"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <span class="inline-block py-1 px-3 rounded-full bg-secondary/20 text-secondary text-sm font-bold tracking-wider uppercase mb-4">Knowledge Base</span>
        <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-6 tracking-tight">Frequently Asked Questions</h1>
        <p class="text-xl text-gray-200 font-light max-w-2xl mx-auto">Find quick answers to common questions about our legal services, consultations, and document processing.</p>
    </div>
</section>

<section class="py-20 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{
        query: '',
        tag: '',
        matches(el) {
            const q = this.query.trim().toLowerCase();
            const tags = (el.dataset.tags || '').split(',').filter(Boolean);
            const text = (el.dataset.text || '').toLowerCase();
            const tagOk = this.tag ? tags.includes(this.tag) : true;
            const qOk = q ? text.includes(q) : true;
            return tagOk && qOk;
        }
    }">
        @php
            $tagSet = [];
            foreach ($faqs as $faq) {
                $keywords = preg_split('/[,;]+/', $faq->keywords ?? '');
                foreach ($keywords as $kw) {
                    $kw = trim($kw);
                    if ($kw !== '') {
                        $tagSet[strtolower($kw)] = $kw;
                    }
                }
            }
            $tags = array_values($tagSet);
            natcasesort($tags);
        @endphp

        <div class="mb-10 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Questions</label>
                <input x-model="query" type="text" placeholder="Search by keyword or phrase" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary dark:focus:ring-secondary focus:border-transparent transition">
            </div>
            @if(count($tags) > 0)
            <div class="flex flex-wrap gap-2">
                <button type="button" @click="tag=''" :class="tag === '' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300'" class="px-3 py-1.5 rounded-full text-xs font-semibold transition">All</button>
                @foreach($tags as $tag)
                    <button type="button"
                        @click="tag='{{ strtolower($tag) }}'"
                        :class="tag === '{{ strtolower($tag) }}' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300'"
                        class="px-3 py-1.5 rounded-full text-xs font-semibold transition">{{ $tag }}</button>
                @endforeach
            </div>
            @endif
        </div>

        <div class="space-y-6">
            @forelse($faqs as $faq)
            @php
                $keywords = collect(preg_split('/[,;]+/', $faq->keywords ?? ''))
                    ->map(fn($kw) => trim($kw))
                    ->filter(fn($kw) => $kw !== '')
                    ->values();
                $tagsLower = $keywords->map(fn($kw) => strtolower($kw))->implode(',');
                $searchText = strtolower($faq->question . ' ' . $faq->answer . ' ' . $keywords->implode(' '));
            @endphp
            <div x-data="{ open: false }"
                 x-show="matches($el)"
                 x-cloak
                 data-tags="{{ $tagsLower }}"
                 data-text="{{ $searchText }}"
                 class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden group hover:border-secondary/50 transition-colors">
                <button @click="open = !open" class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white pr-8 group-hover:text-primary dark:group-hover:text-secondary transition-colors">{{ $faq->question }}</h3>
                    <div class="w-8 h-8 rounded-full bg-primary/10 dark:bg-gray-700 flex items-center justify-center flex-shrink-0 text-primary dark:text-gray-300 group-hover:bg-secondary group-hover:text-white transition-colors">
                        <svg class="h-5 w-5 transform transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </button>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-cloak 
                     class="px-6 pb-6 pt-2 text-gray-600 dark:text-gray-300 leading-relaxed border-t border-gray-50 dark:border-gray-700">
                    <p>{{ $faq->answer }}</p>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 py-8">
                No FAQs available at the moment. Please contact us directly if you have any questions.
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
