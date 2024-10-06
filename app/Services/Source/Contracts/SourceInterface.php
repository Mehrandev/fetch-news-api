<?php

namespace App\Services\Source\Contracts;

interface SourceInterface
{
    /**
     * @param string $category
     * @return array
     */
    public function fetch(string $category): array;

    /**
     * Transform the source articles into a standardized format.
     *
     * @param array $data
     * @return array
     */
    public function transform(array $data): array;
}
