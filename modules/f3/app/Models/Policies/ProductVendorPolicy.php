<?php

namespace Modules\Product\App\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class ProductVendorPolicy
{
    use HandlesAuthorization, STEncodeDecodeTrait;

    /**
     * Determine whether the user can view any models.
     *
     * @param  App\Models\User  $user
     * @return bool
     */
    public function assignProductToVendor(User $use, ProductVendor $productVendor): bool
    {
        return \AuthUtility::hasAbility($user, 'product', 'update');
    }
}
