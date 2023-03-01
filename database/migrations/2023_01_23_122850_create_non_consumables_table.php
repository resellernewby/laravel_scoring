<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_consumables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained();
            // $table->foreignId('location_id')->nullable()->constrained();
            $table->nullableMorphs('non_consumable');
            $table->string('user', 150)->nullable();
            $table->string('serial', 50)->nullable();
            $table->unsignedInteger('economic_age')->nullable();
            $table->decimal('residual_value', 14, 0)->default(0);
            $table->decimal('price', 14, 0)->default(0);
            $table->string('condition')->nullable();
            $table->string('current_status', 50);
            $table->dateTime('purchase_date')->nullable();
            $table->unsignedInteger('warranty_period')->nullable()->comment('dalam bulan');
            $table->string('warranty_provider', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('non_consumables');
    }
};
