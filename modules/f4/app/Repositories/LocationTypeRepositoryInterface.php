<?php

namespace Modules\Locationtype\App\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Modules\Locationtype\App\Models\LocationType;

interface LocationTypeRepositoryInterface
{
    public function getAllLocationTypes(string $threePlId, array $request): Paginator;

    public function store(string $threePlId, int $userId, array $request): LocationType;

    public function update(LocationType $locationType, string $threePlId, int $userId, array $request): LocationType;

    public function locationTypes(string $threePlId);
}
