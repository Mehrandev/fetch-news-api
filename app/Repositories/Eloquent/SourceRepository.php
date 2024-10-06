<?php

namespace App\Repositories\Eloquent;

use App\Models\Source;
use App\Repositories\Contracts\SourceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SourceRepository implements SourceRepositoryInterface
{
    public function getAll(): Collection
    {
        return Source::all();
    }

    public function findById(int $id)
    {
        return Source::find($id);
    }

    public function create(array $data)
    {
        return Source::create($data);
    }

    public function update(int $id, array $data)
    {
        $source = Source::find($id);
        if ($source) {
            $source->update($data);
            return $source;
        }
        return null;
    }

    public function delete(int $id)
    {
        return Source::destroy($id);
    }
}
