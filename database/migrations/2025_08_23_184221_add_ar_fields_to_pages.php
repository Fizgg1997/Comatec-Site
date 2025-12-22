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
    Schema::table('pages', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->text('title_ar')->nullable()->after('title');
        $table->text('excerpt_ar')->nullable()->after('excerpt');
        $table->longText('body_ar')->nullable()->after('body');
    });
}

public function down()
{
    Schema::table('pages', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->dropColumn(['title_ar', 'excerpt_ar', 'body_ar']);
    });
}
};
