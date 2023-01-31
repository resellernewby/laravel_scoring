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
        Schema::create('consumable_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consumable_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->string('action', 50);
            $table->unsignedInteger('qty');
            $table->dateTime('date');
            $table->string('user', 150);
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
        Schema::dropIfExists('consumable_transactions');
    }
};
