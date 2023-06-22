<?php

namespace Modules\Vendor\App\Repositories;
use Illuminate\Support\Collection;

use Modules\Vendor\App\Models\Vendor;
use StallionExpress\AuthUtility\Models\User;
use Illuminate\Contracts\Pagination\Paginator;

interface VendorRepositoryInterface
{
    public function store(User $loggedUser, array $request): bool;

    public function getAllVendors(array $request, User $loggedUser): Paginator;

    public function update(Vendor $vendor, int $userId, array $request): Vendor;

    public function getVendorsBy3plCustomer(int $customerID ,string $search):Collection;

    public function vendorExists(array $request): bool;

}
