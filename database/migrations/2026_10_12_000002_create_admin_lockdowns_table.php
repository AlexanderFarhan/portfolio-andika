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
        if (!Schema::hasTable('admin_lockdowns')) {
            Schema::create('admin_lockdowns', function (Blueprint $table) {
                $table->id();
                $table->boolean('is_locked')->default(false);
                $table->string('lock_token', 100)->nullable();
                $table->string('unlock_otp', 20)->nullable();
                $table->timestamp('otp_expires_at')->nullable();
                $table->timestamp('locked_at')->nullable();
                $table->string('locked_reason')->nullable();
                $table->string('attempted_email')->nullable();
                $table->string('ip_address')->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamp('last_alert_sent_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_lockdowns');
    }
};
