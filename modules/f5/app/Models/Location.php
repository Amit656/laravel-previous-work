<?php

namespace Modules\Location\App\Models;

use App\Helpers\StUtility;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Location\Database\Factories\LocationFactory;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\PrimaryIdEncodeTrait;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class Location extends Model
{
    use SoftDeletes, HasFactory, PrimaryIdEncodeTrait, STEncodeDecodeTrait;

    protected static function newFactory(): Factory
    {
        return LocationFactory::new();
    }

    public static function boot()
    {
        parent::boot();

        //while creating/inserting item into db
        static::creating(function ($location) {
            $location->barcode = self::generateUniqueCode();
        });
    }

    public static function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (self::where('barcode', '=', $code)->first());

        return $code;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $fillable = [
        'three_pl_id',
        'location_type_id',
        'warehouse_id',
        'name',
        'is_pickable',
        'is_sellable',
        'barcode',
        'last_modified_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id')->select('id', 'name');
    }

    public function locationType(): HasOne
    {
        return $this->hasOne(LocationType::class, 'id', 'location_type_id')->select('id', 'name');
    }

    protected $appends = ['hash'];

    protected function threePlId(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->encodeHashValue($value),
        );
    }

    public function canAccess(User $user): bool
    {
        return (int) $this->decodeHashValue($this->three_pl_id) === \AuthUtility::getThreePlIdFor3PlAndStaff($user);
    }
}
