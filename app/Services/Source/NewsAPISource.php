<?php

namespace App\Services\Source;

use App\Services\Source\Contracts\SourceInterface;
use Illuminate\Support\Facades\Http;

class NewsAPISource implements SourceInterface
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.newsapi.api_key');
    }

    /**
     * @param string $category
     * @return array
     */
    public function fetch(string $category): array
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'category' => $category,
            'apiKey' => $this->apiKey,
            'language' => 'en',
            'pageSize' => 10,
        ]);

        return $response->successful() ? $response->json()['articles'] : [];
    }

    /**
     * Transform NewsAPI data to the standard format.
     *
     * @param array $data
     * @return array
     */
    public function transform(array $data): array
    {
        $articles = [];

        foreach ($data as $item) {
            $articles[] = [
                'title' => $item['title'] ?? 'No Title',
                'content' => $item['description'] ?? '',
            ];
        }

        return $articles;
    }
}
