<?php

namespace Modules\Warehouse\App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreePlCustomerWarehouse extends Model
{
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $fillable = [
        'customer_id',
        'warehouse_id',
    ];
}
