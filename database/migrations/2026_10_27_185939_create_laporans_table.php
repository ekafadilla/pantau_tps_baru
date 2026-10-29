
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_pengguna')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('id_tps')
                ->constrained('tps')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('kategori_kondisi');
            $table->text('lokasi')->nullable();
            $table->text('keterangan');
            $table->timestamp('waktu_pelaporan')->useCurrent();

            $table->string('status_laporan')
                ->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
