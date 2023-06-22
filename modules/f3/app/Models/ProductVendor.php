<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Vendor\App\Models\Vendor;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\PrimaryIdEncodeTrait;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class ProductVendor extends Model
{
    use PrimaryIdEncodeTrait, STEncodeDecodeTrait;

    protected $appends = [
        'hash',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];

    protected $fillable = [
        'product_id',
        'vendor_id',
        'price',
        'manufacturer_sku',
    ];

    protected $hidden = [
        'last_modified_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function canAccess(User $user): bool
    {
        return \AuthUtility::hasAbility($user, 'vendor', 'list');
    }
}
