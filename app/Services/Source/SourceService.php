<?php

namespace App\Services\Source;

use App\Repositories\Contracts\SourceRepositoryInterface;

class SourceService
{

    public function __construct(private SourceRepositoryInterface $sourceRepository)
    {
    }

    public function getAllSources()
    {
        return $this->sourceRepository->getAll();
    }

    public function createSource(array $data)
    {
        return $this->sourceRepository->create($data);
    }

    public function updateSource(int $id, array $data)
    {
        return $this->sourceRepository->update($id, $data);
    }

    public function deleteSource(int $id)
    {
        return $this->sourceRepository->delete($id);
    }

    public function getSourceByName(string $name)
    {
        return $this->sourceRepository->getAll()->where('name', $name)->first();
    }

}
