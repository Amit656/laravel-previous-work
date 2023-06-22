<?php

namespace Modules\Vendor\App\Models\Policies;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Modules\Vendor\App\Models\Vendor;
use StallionExpress\AuthUtility\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class VendorPolicy
{
    use HandlesAuthorization, STEncodeDecodeTrait;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return \AuthUtility::hasAbility($user, 'vendor', 'list');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vendor $vendor): bool
    {  
        return \AuthUtility::hasAbility($user, 'vendor', 'edit', $vendor) && $vendor->canAccess($user); 
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool{
        return \AuthUtility::hasAbility($user, 'vendor', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vendor $vendor): bool
    {
        return \AuthUtility::hasAbility($user, 'vendor', 'update', $vendor) && $vendor->canAccess($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vendor $vendor): bool
    {
        return \AuthUtility::hasAbility($user, 'vendor', 'delete', $vendor) && $vendor->canAccess($user);
    }

    /**
     * Determine whether the user can get vendors by 3pl customer.
     */
    public function vendorsBy3plCustomer(User $user): bool
    {
        return \AuthUtility::hasAbility($user, 'vendor', 'list');
    }


    /**
     * Determine whether the user can get products by vendors.
     */
    public function productsByVendor(User $user): bool
    {
        if(isset(Auth::user()->abilities->vendor) === true){
            return true;
        }

        return false;
    }
}
