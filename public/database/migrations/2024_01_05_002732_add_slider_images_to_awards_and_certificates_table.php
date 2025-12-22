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
        Schema::table('awards_and_certificates', function (Blueprint $table) {
            $table->longText('slider_images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('awards_and_certificates', function (Blueprint $table) {
            $table->dropColumn('slider_images');
        });
    }
};
