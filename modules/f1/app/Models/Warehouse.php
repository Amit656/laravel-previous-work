<?php

namespace Modules\Warehouse\App\Models;

use App\Helpers\StUtility;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Warehouse\Database\Factories\WarehouseFactory;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\PrimaryIdEncodeTrait;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class Warehouse extends Model
{
    use SoftDeletes, HasFactory, PrimaryIdEncodeTrait, STEncodeDecodeTrait;

    protected static function newFactory(): Factory
    {
        return WarehouseFactory::new();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $fillable = [
        'three_pl_id',
        'name',
        'latitude',
        'longitude',
        'address',
        'pin_code',
        'city',
        'province',
        'country',
        'threshold_settings',
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
        'threshold_settings' => 'array',
        'ulid' => 'string',
    ];

    protected $appends = ['hash'];

    protected function threePlId(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->encodeHashValue($value),
        );
    }

    public function canAccess(User $user): bool
    {
        return (int)$user->three_pl_id === \AuthUtility::getThreePlIdFor3PlAndStaff($user);
    }
}
