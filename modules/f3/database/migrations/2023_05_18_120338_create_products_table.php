<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('three_pl_customer_id');
            $table->bigInteger('warehouse_id');
            $table->string('name');
            $table->boolean('is_kit')->default(false);
            $table->float('value', 10, 2)->nullable();
            $table->float('weight', 10, 2)->nullable();
            $table->string('sku');
            $table->string('barcode');
            $table->boolean('status')->default(false);
            $table->bigInteger('last_updated_by');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['warehouse_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
