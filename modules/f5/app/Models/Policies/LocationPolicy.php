<?php

namespace Modules\Location\App\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Location\App\Models\Location;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class LocationPolicy
{
    use HandlesAuthorization, STEncodeDecodeTrait;

    /**
     * Determine whether the user can view any models.
     *
     * @param  App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return \AuthUtility::hasAbility($user, 'location', 'list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  App\Models\User  $user
     * @return Modules\Location\App\Models\Location $location
     * @return bool
     */
    public function view(User $user, Location $location): bool
    {
        return \AuthUtility::hasAbility($user, 'location', 'create', $location) && $location->canAccess($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return \AuthUtility::hasAbility($user, 'location', 'create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  App\Models\User  $user
     * @return Modules\Location\App\Models\Location $location
     * @return bool
     */
    public function update(User $user, Location $location): bool
    {
        return \AuthUtility::hasAbility($user, 'location', 'update', $location) && $location->canAccess($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  App\Models\User  $user
     * @return Modules\Location\App\Models\Location $location
     * @return bool
     */
    public function delete(User $user, Location $location): bool
    {
        return \AuthUtility::hasAbility($user, 'location', 'delete', $location) && $location->canAccess($user);
    }
}
