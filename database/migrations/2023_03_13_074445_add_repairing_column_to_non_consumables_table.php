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
        Schema::table('non_consumables', function (Blueprint $table) {
            $table->after('used_end', function (Blueprint $table) {
                $table->dateTime('repair_at')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('non_consumables', function (Blueprint $table) {
            $table->dropColumn('repair_at');
        });
    }
};
