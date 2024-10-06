<?php

namespace App\Factories;

use App\Services\Source\BBCSource;
use App\Services\Source\Contracts\SourceInterface;
use App\Services\Source\NewsAPISource;

class SourceFactory
{
    /**
     * Create an instance of a source class based on the source name.
     *
     * @param string $sourceName
     * @return SourceInterface
     */
    public function createSource(string $sourceName): SourceInterface
    {
        return match ($sourceName) {
            'NewsAPI' => new NewsAPISource(),
            'BBC' => new BBCSource(),
            default => throw new \InvalidArgumentException("Unsupported source: $sourceName"),
        };
    }
}
