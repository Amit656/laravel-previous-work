<?php

namespace Modules\Warehouse\App\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Modules\Warehouse\App\Models\Warehouse;

interface WarehouseRepositoryInterface
{
    public function getAllWarehouses(string $threePlId, array $request): Paginator;

    public function store(string $threePlId, array $request): Warehouse|null;

    public function update(Warehouse $Warehouse, string $threePlId, array $request): array;

    public function warehouses(int $id);

    public function attachCustomerWarehouses(array $request, int $threeCustomerId);

    public function threePlCustomerWarehouses(int $threePlCustomer);

    public function warehouseExists(array $request): bool;
}
