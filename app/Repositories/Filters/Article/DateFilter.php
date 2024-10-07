<?php

namespace App\Repositories\Filters\Article;

use App\Repositories\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class DateFilter implements FilterInterface
{
    /**
     * Apply the date filter to the query.
     *
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    public function apply(Builder $query, $value): Builder
    {
        return $query->whereDate('created_at', $value);
    }
}
