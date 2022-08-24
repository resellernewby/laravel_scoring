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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->foreignId('status_asset_id')->constrained();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('serial')->nullable();
            $table->string('barcode')->nullable();
            $table->decimal('purchase_cost', 14, 0)->default(0);
            $table->tinyInteger('lifetime')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('warranty_period')->nullable();
            $table->dateTime('purchase_at')->nullable();
            $table->dateTime('used_at')->nullable();
            $table->dateTime('rent_at')->nullable();
            $table->dateTime('rent_end')->nullable();
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
        Schema::dropIfExists('assets');
    }
};
