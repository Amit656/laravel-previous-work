<?php

namespace Modules\Warehouse\App\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Warehouse\App\Models\Warehouse;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class WarehousePolicy
{
    use HandlesAuthorization, STEncodeDecodeTrait;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return \AuthUtility::hasAbility($user, 'warehouse', 'list');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Warehouse $warehouse): bool
    {
        return \AuthUtility::hasAbility($user, 'warehouse', 'edit', $warehouse) && $warehouse->canAccess($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return \AuthUtility::hasAbility($user, 'warehouse', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Warehouse $warehouse): bool
    {
        return \AuthUtility::hasAbility($user, 'warehouse', 'update', $warehouse) && $warehouse->canAccess($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Warehouse $warehouse): bool
    {
        return \AuthUtility::hasAbility($user, 'warehouse', 'delete', $warehouse) && $warehouse->canAccess($user);
    }
}
