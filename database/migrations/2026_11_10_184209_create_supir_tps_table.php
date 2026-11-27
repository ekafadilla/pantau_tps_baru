<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supir_tps', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_supir')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('id_tps')
                ->constrained('tps')
                ->cascadeOnDelete();

            $table->string('rute', 150)->nullable();
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->unique(['id_supir', 'id_tps']);
            $table->index(['id_tps', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supir_tps');
    }
};
