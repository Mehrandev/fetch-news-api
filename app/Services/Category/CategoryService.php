<?php

namespace App\Services\Category;

use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryService
{

    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAll();
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function updateCategory(int $id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function deleteCategory(int $id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function getCategoryByName(string $name)
    {
        return $this->categoryRepository->getAll()->where('name', $name)->first();
    }


}
