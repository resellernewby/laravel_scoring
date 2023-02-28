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
            $table->after('warranty_provider', function (Blueprint $table) {
                $table->dateTime('used_at')->nullable();
                $table->dateTime('used_end')->nullable();
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
            $table->dropColumn('used_at');
            $table->dropColumn('used_end');
        });
    }
};
