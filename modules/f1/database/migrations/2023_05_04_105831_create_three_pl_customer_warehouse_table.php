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
        Schema::create('three_pl_customer_warehouses', function (Blueprint $table) {
            $table->integer('customer_id')->unsigned()->index();
            $table->integer('warehouse_id')->unsigned()->index();
            $table->primary(['customer_id', 'warehouse_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('three_pl_customer_warehouses');
    }
};
