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
        Schema::create('add_consumables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consumable_id')->constrained();
            $table->integer('qty');
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
        Schema::dropIfExists('add_consumables');
    }
};
