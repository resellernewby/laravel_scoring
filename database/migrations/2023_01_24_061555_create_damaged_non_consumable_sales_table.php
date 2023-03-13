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
        Schema::create('damaged_non_consumable_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('non_consumable_id')->constrained();
            $table->dateTime('sold_at');
            $table->string('sold_to', 150);
            $table->string('sold_by', 150);
            $table->decimal('sold_price', 14, 0)->nullable();
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
        Schema::dropIfExists('damaged_non_consumable_sales');
    }
};
