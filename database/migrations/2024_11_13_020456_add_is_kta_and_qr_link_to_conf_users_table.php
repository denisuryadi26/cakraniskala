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
        Schema::table('conf_users', function (Blueprint $table) {
            $table->tinyInteger('is_kta')->after('status')->default(0); // 1 untuk true, 0 untuk false
            $table->string('qr_link', 255)->after('dokument')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conf_users', function (Blueprint $table) {
            $table->dropColumn('is_kta');
            $table->dropColumn('qr_link');
        });
    }
};
