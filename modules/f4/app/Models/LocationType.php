<?php

namespace Modules\Locationtype\App\Models;

use App\Helpers\StUtility;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Locationtype\Database\Factories\LocationTypeFactory;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\PrimaryIdEncodeTrait;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class LocationType extends Model
{
    use SoftDeletes, HasFactory, PrimaryIdEncodeTrait, STEncodeDecodeTrait;

    protected static function newFactory(): Factory
    {
        return LocationTypeFactory::new();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'three_pl_id',
        'last_modified_by',
    ];

    protected $hidden = [
        'last_modified_by',
        'created_at',
        'updated_at',
        'deleted_at',
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
        return (int) $this->decodeHashValue($this->three_pl_id) === \AuthUtility::getThreePlIdFor3PlAndStaff($user);
    }
}
