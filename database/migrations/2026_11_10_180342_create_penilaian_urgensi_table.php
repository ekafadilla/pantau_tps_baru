<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian_urgensi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_laporan')
                ->constrained('laporans')
                ->cascadeOnDelete();

            $table->string('jenis_penilaian', 20);

            $table->foreignId('id_penilai')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->unsignedTinyInteger('kepenuhan_tps');
            $table->unsignedTinyInteger('sampah_meluber');
            $table->unsignedTinyInteger('dampak_lingkungan');
            $table->unsignedTinyInteger('bau_hama');
            $table->unsignedTinyInteger('gangguan_masyarakat');

            $table->decimal('skor_urgensi', 5, 2);
            $table->string('rekomendasi_urgensi', 20);
            $table->text('catatan')->nullable();

            $table->timestamps();

            $table->index(['id_laporan', 'jenis_penilaian']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian_urgensi');
    }
};