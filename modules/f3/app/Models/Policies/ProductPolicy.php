<?php

namespace Modules\Product\App\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Product\App\Models\Product;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class ProductPolicy
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
        return \AuthUtility::hasAbility($user, 'product', 'list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  App\Models\User  $user
     * @return Modules\Product\App\Models\Product $product
     * @return bool
     */
    public function view(User $user, Product $product): bool
    {
        return \AuthUtility::hasAbility($user, 'product', 'edit', $product) && $product->canAccess($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return \AuthUtility::hasAbility($user, 'product', 'create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  App\Models\User  $user
     * @return Modules\Product\App\Models\Product $product
     * @return bool
     */
    public function update(User $user, Product $product): bool
    {
        return \AuthUtility::hasAbility($user, 'product', 'update', $product) && $product->canAccess($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  App\Models\User  $user
     * @return Modules\Product\App\Models\Product $product
     * @return bool
     */
    public function delete(User $user, Product $product): bool
    {
        return \AuthUtility::hasAbility($user, 'product', 'delete', $product) && $product->canAccess($user);
    }

    /**
     * Determine whether the user can assign product to vendor.
     */
    public function assignProductToVendor(User $user, Product $product): bool
    {
        return \AuthUtility::hasAbility($user, 'product', 'update') && $product->vendors->canAccess($user);
    }

    /**
     * Determine whether the user can search product for vendor
     *
     * @param  App\Models\User  $user
     * @return bool
     */
    public function searchProductsForVendor(User $user): bool
    {
        return \AuthUtility::hasAbility($user, 'product', 'list');
    }
}
