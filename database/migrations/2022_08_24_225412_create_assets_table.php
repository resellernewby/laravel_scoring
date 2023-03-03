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
            $table->foreignId('suplier_id')->constrained();
            $table->foreignId('funds_source_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->string('name');
            $table->string('barcode', 15)->unique()->nullable();
            $table->string('model', 50)->unique()->nullable();
            $table->enum('type', ['consumable', 'non-consumable']);
            $table->integer('qty')->default(0);
            $table->decimal('current_price', 14, 0)->default(0);
            $table->dateTime('purchase_at')->nullable();
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
