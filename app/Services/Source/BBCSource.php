<?php

namespace App\Services\Source;

use App\Services\Source\Contracts\SourceInterface;
use Illuminate\Support\Facades\Http;

class BBCSource implements SourceInterface
{
    /**
     * @param string $category
     * @return array
     */
    public function fetch(string $category): array
    {
        $response = Http::get('https://feeds.bbci.co.uk/news/rss.xml');
        return $this->parseXMLResponse($response->body());
    }

    /**
     * Transform BBC data to the standard format.
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
                'category' => 'BBC News',
                'source' => 'BBC',
            ];
        }

        return $articles;
    }

    private function parseXMLResponse(string $xmlContent): array
    {
        // Parse the XML into a PHP array and return the articles
        $parsed = simplexml_load_string($xmlContent, "SimpleXMLElement", LIBXML_NOCDATA);
        return json_decode(json_encode($parsed), true)['channel']['item'] ?? [];
    }
}
