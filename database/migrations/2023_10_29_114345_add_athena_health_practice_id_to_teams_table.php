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
        Schema::table('teams', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('teams', 'athena_health_practice_id')) {
                $table->string('athena_health_practice_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            //
            if (Schema::hasColumn('teams', 'athena_health_practice_id')) {
                $table->dropColumn('athena_health_practice_id');
            }
        });
    }
};
