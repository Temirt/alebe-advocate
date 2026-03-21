<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ChatMessage;
use App\Models\Faq;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AutoGenerateFaqs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'faq:generate-from-chat {--threshold=2 : Minimum number of occurrences to create an FAQ}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Analyze chat messages and create new FAQs for frequently asked questions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threshold = (int) $this->option('threshold');
        $this->info("Scanning chat messages with frequency threshold: {$threshold}");

        // 1. Group similar messages (naive approach: exact match or similar structure)
        // In a real production app, we would use embeddings or similarity search.
        // Here we will normalize strings and count.
        
        $messages = ChatMessage::whereNotNull('message')
            ->select('message', 'assistant_reply')
            ->get();

        $groups = [];
        
        foreach ($messages as $msg) {
            // Normalize: lowercase, remove punctuation
            $normalized = strtolower(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $msg->message)));
            if (strlen($normalized) < 10) continue; // Skip very short messages like "hello"

            if (!isset($groups[$normalized])) {
                $groups[$normalized] = [
                    'count' => 0,
                    'original_question' => $msg->message,
                    'last_reply' => $msg->assistant_reply,
                    'samples' => []
                ];
            }
            $groups[$normalized]['count']++;
            $groups[$normalized]['samples'][] = $msg->message;
        }

        $created = 0;

        foreach ($groups as $key => $data) {
            if ($data['count'] >= $threshold) {
                // Check if similar FAQ already exists to avoid duplicates
                $exists = Faq::where('question', 'LIKE', "%{$data['original_question']}%")->exists();
                
                if (!$exists && $data['last_reply']) {
                    // Create new FAQ
                    Faq::create([
                        'question' => $this->formatQuestion($data['original_question']),
                        'answer' => $data['last_reply'],
                        'is_published' => false, // Draft mode for admin review
                        'keywords' => $this->extractKeywords($data['original_question'])
                    ]);
                    
                    $this->info("Created Draft FAQ: " . $data['original_question']);
                    $created++;
                }
            }
        }

        $this->info("Completed. Created {$created} new draft FAQs.");
    }

    private function formatQuestion($q)
    {
        return ucfirst(trim($q));
    }

    private function extractKeywords($q)
    {
        // Simple keyword extraction (remove stop words)
        $stopWords = ['the', 'is', 'at', 'which', 'on', 'and', 'a', 'an', 'in', 'to', 'can', 'i', 'how', 'do'];
        $words = explode(' ', strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $q)));
        $keywords = array_diff($words, $stopWords);
        return implode(',', array_slice($keywords, 0, 5));
    }
}
