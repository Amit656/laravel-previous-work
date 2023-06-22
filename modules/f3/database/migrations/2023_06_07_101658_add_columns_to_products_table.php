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
        Schema::table('products', function (Blueprint $table) {
            $table->float('height', 10, 2)->nullable();
            $table->float('width', 10, 2)->nullable();
            $table->float('length', 10, 2)->nullable();
            $table->float('custom_value', 10, 2)->nullable();
            $table->string('custom_description', 255)->nullable();
            $table->float('price', 10, 2)->nullable();
            $table->unsignedBigInteger('reserve')->nullable();
            $table->unsignedBigInteger('reorder_amount')->nullable();
            $table->unsignedBigInteger('reorder_level')->nullable();
            $table->unsignedBigInteger('replenishment_level')->nullable();
            $table->boolean('item_count_full')->default(false);
            $table->unsignedInteger('country_of_manufacturer')->nullable();
            $table->unsignedInteger('currency')->nullable();
            $table->unsignedBigInteger('tarrif_code')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('final_sale_item')->default(false);
            $table->boolean('cycle_count')->default(false);
            $table->boolean('add_to_invoice')->default(false);
            $table->boolean('dont_show_on_custom_form')->default(false)->comment("Don't show this item on customs forms, even if it's in the order");
            $table->boolean('assembly_sku')->default(false)->comment('This is an Assembly SKU used in Work Orders');
            $table->boolean('dropship_only')->default(false);
            $table->boolean('need_serial_number')->default(false);
            $table->unsignedBigInteger('serial_number')->nullable();
            $table->boolean('lithium_ion')->default(false);
            $table->boolean('is_virtual')->default(false);
            $table->unsignedInteger('dangerous_goods_code')->nullable();
            $table->boolean('auto_fulfill')->default(false);
            $table->boolean('auto_pack')->default(false);
            $table->string('product_note', 255)->nullable();
            $table->string('product_packer_note', 255)->nullable();
            $table->string('product_return_note', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['height', 'width', 'length', 'custom_value', 'custom_description', 'price', 'reserve', 'reorder_amount', 'reorder_level', 'replenishment_level', 'item_count_full', 'country_of_manufacturer', 'currency',
                'tarrif_code', 'tags', 'final_sale_item', 'cycle_count', 'add_to_invoice',
                'dont_show_on_custom_form', 'assembly_sku', 'dropship_only', 'need_serial_number', 'lithium_ion',
                'is_virtual', 'dangerous_goods_code', 'auto_fulfill', 'auto_pack', 'product_note', 'product_packer_note', 'product_return_note']);
        });
    }
};
