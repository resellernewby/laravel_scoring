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
        Schema::create('non_consumable_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('non_consumable_id')->constrained();
            // $table->foreignId('location_id')->constrained();
            $table->nullableMorphs('nct_able');
            $table->string('action', 50);
            $table->string('condition', 50);
            $table->dateTime('date')->nullable();
            $table->string('user', 150)->nullable();
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
        Schema::dropIfExists('non_consumable_transactions');
    }
};
