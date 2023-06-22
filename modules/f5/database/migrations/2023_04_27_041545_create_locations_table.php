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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('three_pl_id');
            $table->foreignId('location_type_id')->constrained('location_types')->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
            $table->string('name');
            $table->boolean('is_pickable')->default(false)->comment('0:No, 1:Yes');
            $table->boolean('is_sellable')->default(false)->comment('0:No, 1:Yes');
            $table->string('barcode');
            $table->bigInteger('last_modified_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
