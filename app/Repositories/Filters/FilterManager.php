<?php

namespace App\Repositories\Filters;

use Illuminate\Database\Eloquent\Builder;

class FilterManager
{
    private array $filters = [];

    /**
     * Register a filter class with a key.
     *
     * @param string $key
     * @param FilterInterface $filter
     */
    public function addFilter(string $key, FilterInterface $filter): void
    {
        $this->filters[$key] = $filter;
    }

    /**
     * Apply all registered filters to the query.
     *
     * @param Builder $query
     * @param array $conditions
     * @return Builder
     */
    public function apply(Builder $query, array $conditions): Builder
    {
        foreach ($conditions as $key => $value) {
            if (isset($this->filters[$key]) && !empty($value)) {
                $this->filters[$key]->apply($query, $value);
            }
        }

        return $query;
    }
}
