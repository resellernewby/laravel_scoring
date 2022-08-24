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
        Schema::create('consumables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained();
            $table->string('name');
            $table->integer('qty');
            $table->string('image')->nullable();
            $table->string('barcode')->nullable();
            $table->tinyInteger('lifetime')->nullable();
            $table->text('description')->nullable();
            $table->decimal('purchase_cost', 14, 0)->default(0);
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
        Schema::dropIfExists('consumables');
    }
};
