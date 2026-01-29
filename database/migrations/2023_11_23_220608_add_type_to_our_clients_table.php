<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // ✅ Prevent crash if table doesn't exist
        if (!Schema::hasTable('our_clients')) {
            return;
        }

        Schema::table('our_clients', function (Blueprint $table) {
            // Example: only add if column not exists
            if (!Schema::hasColumn('our_clients', 'type')) {
                $table->string('type')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('our_clients')) {
            return;
        }

        Schema::table('our_clients', function (Blueprint $table) {
            if (Schema::hasColumn('our_clients', 'type')) {
                $table->dropColumn('type');
            }
        });
    }
};
