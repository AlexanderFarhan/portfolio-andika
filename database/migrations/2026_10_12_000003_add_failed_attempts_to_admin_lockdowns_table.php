<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('admin_lockdowns')) {
            Schema::table('admin_lockdowns', function (Blueprint $table) {
                if (!Schema::hasColumn('admin_lockdowns', 'failed_attempts')) {
                    $table->integer('failed_attempts')->default(0)->after('is_locked');
                }
                if (!Schema::hasColumn('admin_lockdowns', 'last_failed_at')) {
                    $table->timestamp('last_failed_at')->nullable()->after('failed_attempts');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('admin_lockdowns')) {
            Schema::table('admin_lockdowns', function (Blueprint $table) {
                if (Schema::hasColumn('admin_lockdowns', 'failed_attempts')) {
                    $table->dropColumn('failed_attempts');
                }
                if (Schema::hasColumn('admin_lockdowns', 'last_failed_at')) {
                    $table->dropColumn('last_failed_at');
                }
            });
        }
    }
};
