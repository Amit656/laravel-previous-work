<?php

namespace Modules\Locationtype\App\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Locationtype\App\Models\LocationType;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class LocationTypePolicy
{
    use HandlesAuthorization, STEncodeDecodeTrait;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return \AuthUtility::hasAbility($user, 'locationType', 'list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  App\Models\User  $user
     * @return Modules\LocationType\App\Models\LocationType $location
     * @return bool
     */
    public function view(User $user, LocationType $locationType): bool
    {
        return \AuthUtility::hasAbility($user, 'locationType', 'edit', $locationType) && $locationType->canAccess($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return \AuthUtility::hasAbility($user, 'locationType', 'create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  App\Models\User  $user
     * @return Modules\LocationType\App\Models\LocationType $location
     * @return bool
     */
    public function update(User $user, LocationType $locationType): bool
    {
        return \AuthUtility::hasAbility($user, 'locationType', 'update', $locationType) && $locationType->canAccess($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  App\Models\User  $user
     * @return Modules\LocationType\App\Models\LocationType $location
     * @return bool
     */
    public function delete(User $user, LocationType $locationType): bool
    {
        return \AuthUtility::hasAbility($user, 'locationType', 'delete', $locationType) && $locationType->canAccess($user);
    }
}
