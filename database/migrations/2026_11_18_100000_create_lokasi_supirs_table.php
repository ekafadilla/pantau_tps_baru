<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lokasi_supirs', function (Blueprint $table) {
            $table->id();

            // Satu baris per supir: selalu berisi posisi terakhir.
            $table->foreignId('id_supir')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->unsignedInteger('akurasi')->nullable(); // meter

            // updated_at dipakai sebagai "terakhir terlihat".
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokasi_supirs');
    }
};