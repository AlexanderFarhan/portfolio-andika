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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('about_title')->nullable()->default('Tentang Andika Amansyah')->after('about_me');
            $table->text('about_subtitle')->nullable()->after('about_title');
            $table->json('about_pillars')->nullable()->after('about_subtitle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['about_title', 'about_subtitle', 'about_pillars']);
        });
    }
};
