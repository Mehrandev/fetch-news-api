<?php

namespace App\Repositories\Filters\Article;

use App\Repositories\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class SourceFilter implements FilterInterface
{
    public function apply(Builder $query, $value): Builder
    {
        if (is_array($value)) {
            return $query->whereIn('source_id', $value);
        }

        return $query->where('source_id', $value);
    }
}
