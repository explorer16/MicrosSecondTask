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
        Schema::table('oauth_auth_codes', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->foreignUuid('user_id')->index();
        });

        Schema::table('oauth_access_tokens', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->foreignUuid('user_id')->nullable()->index();
        });

        Schema::table('oauth_device_codes', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->foreignUuid('user_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('oauth_auth_codes', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->foreignId('user_id')->index();
        });

        Schema::table('oauth_access_tokens', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->foreignId('user_id')->nullable()->index();
        });

        Schema::table('oauth_device_codes', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->foreignId('user_id')->nullable()->index();
        });
    }
};
