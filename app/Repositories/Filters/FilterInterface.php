<?php

namespace App\Repositories\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    /**
     * Apply the filter to the query.
     *
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    public function apply(Builder $query, $value): Builder;
}
