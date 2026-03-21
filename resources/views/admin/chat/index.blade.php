@extends('layouts.app')

@section('title', 'Site Chat Messages')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Site Chat Messages</h1>
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
                    <th class="py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">When</th>
                    <th class="py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">From</th>
                    <th class="py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Message</th>
                    <th class="py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Reply</th>
                    <th class="py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">IP</th>
                    <th class="py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $m)
                    <tr class="border-b dark:border-gray-700 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="py-4 px-6">{{ $m->created_at->diffForHumans() }}</td>
                        <td class="py-4 px-6">{{ $m->name ?? $m->email ?? 'Visitor' }}</td>
                        <td class="py-4 px-6">{{ Str::limit($m->message, 180) }}</td>
                        <td class="py-4 px-6">
                            @if($m->assistant_reply)
                                <span class="text-green-600 dark:text-green-400 font-semibold">Replied</span>
                            @else
                                <span class="text-gray-500">Pending</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">{{ $m->ip }}</td>
                        <td class="py-4 px-6">
                            <button type="button" class="toggle-reply inline-block border border-primary text-primary dark:text-blue-400 dark:border-blue-400 hover:bg-primary hover:text-white dark:hover:bg-blue-900 dark:hover:text-blue-100 px-3 py-1 rounded text-sm transition" data-target="reply-{{ $m->id }}">
                                Reply
                            </button>
                        </td>
                    </tr>
                    <tr id="reply-{{ $m->id }}" class="border-b dark:border-gray-700 bg-gray-50/60 dark:bg-gray-900/40 hidden">
                        <td colspan="6" class="py-6 px-6">
                            <form action="{{ route('admin.chat.reply', $m) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Assistant Reply</label>
                                    <textarea name="assistant_reply" rows="3" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">{{ old('assistant_reply', $m->assistant_reply) }}</textarea>
                                </div>

                                @if(isset($faqs) && $faqs->count())
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Use FAQ Answer (optional)</label>
                                    <select class="faq-select w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                                        <option value="">Select a FAQ to copy its answer</option>
                                        @foreach($faqs as $faq)
                                            <option value="{{ $faq->answer }}">{{ $faq->question }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                <div class="flex flex-wrap items-center gap-4">
                                    <label class="inline-flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                        <input type="checkbox" name="add_to_faq" value="1" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                        Add this reply to FAQ
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <label class="text-sm text-gray-700 dark:text-gray-300">Rating (0-5)</label>
                                        <input type="number" name="rating" min="0" max="5" value="3" class="w-20 px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div class="flex-1 min-w-[200px]">
                                        <input type="text" name="keywords" placeholder="keywords (comma separated)" class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="bg-primary text-white px-5 py-2 rounded-lg font-semibold hover:bg-primary/90 transition">
                                        Save Reply
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-reply').forEach(btn => {
        btn.addEventListener('click', () => {
            const target = document.getElementById(btn.dataset.target);
            if (target) target.classList.toggle('hidden');
        });
    });

    document.querySelectorAll('.faq-select').forEach(select => {
        select.addEventListener('change', (e) => {
            const form = e.target.closest('form');
            const textarea = form ? form.querySelector('textarea[name="assistant_reply"]') : null;
            if (textarea && e.target.value) {
                textarea.value = e.target.value;
            }
        });
    });
});
</script>
@endpush
