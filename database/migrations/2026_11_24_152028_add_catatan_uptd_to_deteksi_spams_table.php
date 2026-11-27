<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('deteksi_spams', 'catatan_uptd')) {
            Schema::table('deteksi_spams', function (Blueprint $table) {
                $table->text('catatan_uptd')->nullable()->after('catatan_admin');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('deteksi_spams', 'catatan_uptd')) {
            Schema::table('deteksi_spams', function (Blueprint $table) {
                $table->dropColumn('catatan_uptd');
            });
        }
    }
};
