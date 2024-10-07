<?php

namespace App\Repositories\Filters\Article;

use App\Repositories\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class SearchFilter implements FilterInterface
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->where(function ($q) use ($value) {
            $q->where('title', 'like', '%' . $value . '%')
                ->orWhere('content', 'like', '%' . $value . '%');
        });
    }
}
