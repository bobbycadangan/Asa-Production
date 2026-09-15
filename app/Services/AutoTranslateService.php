<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AutoTranslateService
{
    /**
     * Translate a set of Indonesian strings to English in a single API call.
     *
     * @param  array<string, string|null>  $texts  key => Indonesian text
     * @return array<string, string>  key => English text (only for keys that had non-empty input)
     */
    public function translateBatch(array $texts): array
    {
        $texts = array_filter($texts, fn ($value) => filled($value));

        if (empty($texts)) {
            return [];
        }

        $apiKey = config('services.groq.key');

        if (! $apiKey) {
            Log::warning('AutoTranslate: GROQ_API_KEY belum diset di .env, translate dilewati.');

            return [];
        }

        $prompt = "Terjemahkan setiap nilai JSON berikut dari Bahasa Indonesia ke Bahasa Inggris. "
            ."Ini teks untuk website perusahaan jasa IT, jadi pakai gaya bahasa marketing/profesional yang natural, bukan terjemahan kaku kata-per-kata. "
            ."Pertahankan setiap key persis sama. Jangan menerjemahkan placeholder seperti {site}. "
            ."Balas HANYA dengan objek JSON valid, tanpa teks lain, tanpa markdown code fence.\n\n"
            .json_encode($texts, JSON_UNESCAPED_UNICODE);

        try {
            $response = Http::withToken($apiKey)
                ->timeout(30)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => config('services.groq.model'),
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a precise JSON-in, JSON-out translation engine.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0.3,
                    'max_tokens' => 2000,
                    'response_format' => ['type' => 'json_object'],
                ]);

            if ($response->failed()) {
                Log::error('AutoTranslate: Groq API error', ['status' => $response->status(), 'body' => $response->body()]);

                return [];
            }

            $content = trim((string) $response->json('choices.0.message.content'));
            $decoded = json_decode($content, true);

            if (! is_array($decoded)) {
                Log::error('AutoTranslate: respons bukan JSON valid', ['content' => $content]);

                return [];
            }

            // Hanya kembalikan key yang memang diminta, dan pastikan nilainya string.
            $result = [];
            foreach ($texts as $key => $original) {
                if (isset($decoded[$key]) && is_string($decoded[$key]) && $decoded[$key] !== '') {
                    $result[$key] = $decoded[$key];
                }
            }

            return $result;
        } catch (\Throwable $e) {
            Log::error('AutoTranslate: exception', ['message' => $e->getMessage()]);

            return [];
        }
    }
}
