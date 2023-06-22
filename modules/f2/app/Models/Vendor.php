<?php

namespace Modules\Vendor\App\Models;

use App\Helpers\StUtility;
use Illuminate\Database\Eloquent\Model;
use StallionExpress\AuthUtility\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use StallionExpress\AuthUtility\Enums\UserTypeEnum;
use Modules\Vendor\Database\Factories\VendorFactory;
use Modules\Vendor\App\Models\ThreePlCustomerVendors;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;
use StallionExpress\AuthUtility\Trait\PrimaryIdEncodeTrait;

class Vendor extends Model
{
    use SoftDeletes, HasFactory, PrimaryIdEncodeTrait, STEncodeDecodeTrait;

    protected static function newFactory(): Factory
    {
        return VendorFactory::new ();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $fillable = [
        'three_pl_customer_id',
        'name',
        'email',
        'account_number',
        'internal_note',
        'po_note',
        'address_one',
        'address_two',
        'city',
        'zip_code',
        'country',
        'state',
        'currency',
        'last_modified_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
    ];

    protected $appends = ['hash'];
    
    protected function threePlCustomerId(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->encodeHashValue($value),
        );
    }

    protected function threePlId(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->encodeHashValue($value),
        );
    }

    public function canAccess(User $user): bool
    {
        switch ($user->user_type->value) {
            case UserTypeEnum::THREE_PL->value:
            case UserTypeEnum::THREE_PL_STAFF->value:
                return \AuthUtility::check3plCustomerExists(\AuthUtility::getThreePlIdFor3PlAndStaff($user), $this->three_pl_customer_id);
                break;
            case UserTypeEnum::THREE_PL_CUSTOMER_STAFF->value:
            case UserTypeEnum::THREE_PL_CUSTOMER->value:
                return (int) $this->decodeHashValue($this->three_pl_customer_id) === \AuthUtility::getCustomerIdFor3PlCustomerAndStaff($user);
                break;
        }
        return false;
    }
}
