<?php

namespace App\Repositories\Filters\Article;

use App\Repositories\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter implements FilterInterface
{
    public function apply(Builder $query, $value): Builder
    {
        if (is_array($value)) {
            return $query->whereIn('category_id', $value);
        }

        return $query->where('category_id', $value);
    }
}
