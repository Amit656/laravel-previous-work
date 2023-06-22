<?php

namespace Modules\Location\App\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Modules\Location\App\Models\Location;

interface LocationRepositoryInterface
{
    public function getAllLocations(string $threePlId, array $request): Paginator;

    public function store(string $threePlId, int $userId, array $request): Location;

    public function update(Location $location, string $threePlId, int $userId, array $request): Location;
}
