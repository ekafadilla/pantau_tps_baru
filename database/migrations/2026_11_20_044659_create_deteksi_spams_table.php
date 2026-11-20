<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deteksi_spams', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_laporan')
                ->nullable()
                ->constrained('laporans')
                ->nullOnDelete();

            $table->foreignId('id_tps')
                ->constrained('tps')
                ->restrictOnDelete();

            $table->foreignId('id_pengguna')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('jenis_deteksi', 50);
            $table->unsignedInteger('jumlah_laporan')->default(1);

            $table->timestamp('periode_mulai')->nullable();
            $table->timestamp('periode_selesai')->nullable();

            $table->string('status_peninjauan', 30)
                ->default('perlu_ditinjau');

            $table->text('catatan_admin')->nullable();

            $table->timestamps();

            $table->index(['id_tps', 'jenis_deteksi']);
            $table->index(['status_peninjauan', 'created_at']);
            $table->index(['id_pengguna', 'jenis_deteksi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deteksi_spams');
    }
};
