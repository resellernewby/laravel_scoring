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
        Schema::create('returned_non_consumables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('non_consumable_id')->constrained();
            $table->foreignId('rack_id')->nullable()->constrained();
            $table->dateTime('returned_at');
            $table->string('returned_by', 150);
            $table->string('condition', 50);
            $table->string('description')->nullable();
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
        Schema::dropIfExists('returned_non_consumables');
    }
};
