<?php

namespace Modules\Product\App\Models;

use App\Helpers\StUtility;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Database\Factories\ProductFactory;
use StallionExpress\AuthUtility\Enums\UserTypeEnum;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\PrimaryIdEncodeTrait;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class Product extends Model
{
    use PrimaryIdEncodeTrait, STEncodeDecodeTrait, SoftDeletes, HasFactory;

    protected $appends = [
        'hash',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
        'tags' => 'array',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

    protected $fillable = [
        'three_pl_customer_id',
        'warehouse_id',
        'name',
        'is_kit',
        'value',
        'weight',
        'sku',
        'barcode',
        'status',
        'last_updated_by',
        'height',
        'width',
        'length',
        'custom_value',
        'custom_description',
        'price',
        'reserve',
        'reorder_amount',
        'reorder_level',
        'replenishment_level',
        'item_count_full',
        'country_of_manufacturer',
        'currency',
        'tarrif_code',
        'tags',
        'final_sale_item',
        'cycle_count',
        'add_to_invoice',
        'dont_show_on_custom_form',
        'assembly_sku',
        'dropship_only',
        'need_serial_number',
        'serial_number',
        'lithium_ion',
        'is_virtual',
        'dangerous_goods_code',
        'auto_fulfill',
        'auto_pack',
        'product_note',
        'product_packer_note',
        'product_return_note',
    ];

    public static function generateUniqueSerialNumber()
    {
        do {
            $serialNumber = random_int(100000, 999999);
        } while (self::where('serial_number', '=', $serialNumber)->first());

        return $serialNumber;
    }

    public static function generateBarcodeCode()
    {
        do {
            $barcode = random_int(100000, 999999);
        } while (self::where('barcode', '=', $barcode)->first());

        return $barcode;
    }

    protected $hidden = [
        'last_modified_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function threePlId(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->encodeHashValue($value),
        );
    }

    protected function threePlCustomerId(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->encodeHashValue($value),
        );
    }

    protected function isKit(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => ($value == 1) ? true : false,
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => ($value == 1) ? true : false,
        );
    }

    protected function warehouseId(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->encodeHashValue($value),
        );
    }

    public function vendors(): HasMany
    {
        return $this->hasMany(ProductVendor::class, 'product_id', 'id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function canAccess(User $user): bool
    {
        switch ($user->user_type->value) {
            case UserTypeEnum::THREE_PL->value:
            case UserTypeEnum::THREE_PL_STAFF->value:
                return array_key_exists($this->warehouse_id, $user->warehouses);
                break;
            case UserTypeEnum::THREE_PL_CUSTOMER_STAFF->value:
            case UserTypeEnum::THREE_PL_CUSTOMER->value:
                return (int) $this->decodeHashValue($this->three_pl_customer_id) === \AuthUtility::getCustomerIdFor3PlCustomerAndStaff($user);
                break;
        }

        return false;
    }
}
