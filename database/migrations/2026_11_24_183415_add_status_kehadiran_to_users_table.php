<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status_kehadiran', 30)->default('tersedia')->after('id_wilayah');
            $table->text('keterangan_kehadiran')->nullable()->after('status_kehadiran');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status_kehadiran', 'keterangan_kehadiran']);
        });
    }
};