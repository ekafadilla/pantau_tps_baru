
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foto_laporans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_laporan')
                ->constrained('laporans')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('nama_file');
            $table->string('path_foto');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_laporans');
    }
};
