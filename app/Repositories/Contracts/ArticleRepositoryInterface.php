<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleRepositoryInterface
{
    public function getAll(array $filters = []): Collection;

    public function findById(int $id);

    public function create(array $data);


    public function update(int $id, array $data);

    public function delete(int $id);

    public function getFilteredArticles(array $filters = []): LengthAwarePaginator;

    public function findOrFailById(int $id);

    public function insertMany(array $articles);
}
