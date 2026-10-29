<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('armadas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_wilayah')
                ->constrained('wilayahs')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('kode_armada')->unique();
            $table->string('jenis_armada')->nullable();
            $table->string('nomor_polisi')->nullable();
            $table->string('status_armada')->default('tersedia');

            $table->timestamps();
        });

        Schema::table('laporans', function (Blueprint $table) {
            $table->foreignId('id_supir')
                ->nullable()
                ->after('id_tps')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('id_armada')
                ->nullable()
                ->after('id_supir')
                ->constrained('armadas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('tingkat_urgensi')->nullable();
            $table->timestamp('target_waktu')->nullable();
            $table->text('instruksi_penanganan')->nullable();
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_kirim_pemeriksaan')->nullable();
        });

        Schema::create('bukti_penanganans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_laporan')
                ->constrained('laporans')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('id_supir')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('foto_path');
            $table->text('keterangan');
            $table->timestamp('waktu_pengiriman')->useCurrent();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukti_penanganans');

        Schema::table('laporans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_armada');
            $table->dropConstrainedForeignId('id_supir');
            $table->dropColumn([
                'tingkat_urgensi',
                'target_waktu',
                'instruksi_penanganan',
                'waktu_mulai',
                'waktu_kirim_pemeriksaan',
            ]);
        });

        Schema::dropIfExists('armadas');
    }
};