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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('three_pl_customer_id');
            $table->string('name');
            $table->string('email');
            $table->string('account_number')->nullable();
            $table->text('internal_note')->nullable();
            $table->text('po_note')->nullable();
            $table->string('address_one')->nullable();
            $table->string('address_two')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->integer('country')->nullable();
            $table->string('state')->nullable();
            $table->integer('currency')->nullable();
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
        Schema::dropIfExists('vendors');
    }
};
