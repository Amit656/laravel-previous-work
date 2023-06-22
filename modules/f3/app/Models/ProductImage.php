<?php

namespace Modules\Product\App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class ProductImage extends Model
{
    use STEncodeDecodeTrait, SoftDeletes;

    const IMAGE_PATH = 'product';

    protected $appends = [
        'hash',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];

    protected $fillable = [
        'product_id',
        'image',
    ];

    protected $hidden = [
        'last_modified_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Helper::getImagePath(self::IMAGE_PATH.'/'.$this->product_id.'/'.$value),
        );
    }

    public function getHashAttribute(): string
    {
        return $this->encodeHashValue($this->id);
    }
}
