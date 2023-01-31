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
        Schema::create('asset_warehouse', function (Blueprint $table) {
            $table->foreignId('asset_id')->constrained('assets');
            $table->foreignId('warehouse_id')->constrained('warehouses');
            $table->unsignedInteger('qty')->nullable();
            $table->decimal('price', 14, 0)->nullable()->comment('Harga barang saat input stok');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_warehouse');
    }
};
