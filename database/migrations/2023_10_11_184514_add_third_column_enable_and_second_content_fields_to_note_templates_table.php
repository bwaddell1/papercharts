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
        Schema::table('note_templates', function (Blueprint $table) {
            //
            $table->json('second_content')->nullable();
            $table->boolean('third_column_enabled')->default(false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('note_templates', function (Blueprint $table) {
            //
            $table->dropColumn([
                'second_content',
                'third_column_enabled',
            ]);
        });
    }
};
