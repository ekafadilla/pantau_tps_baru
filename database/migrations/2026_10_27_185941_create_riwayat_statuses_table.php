
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_statuses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_laporan')
                ->constrained('laporans')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('id_pengguna')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('status_sebelumnya')->nullable();
            $table->string('status_baru');
            $table->text('catatan')->nullable();
            $table->timestamp('waktu_perubahan')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_statuses');
    }
};
