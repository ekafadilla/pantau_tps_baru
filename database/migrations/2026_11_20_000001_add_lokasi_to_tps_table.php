<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tps', function (Blueprint $table) {
            if (!Schema::hasColumn('tps', 'lokasi')) {
                $table->string('lokasi')->nullable()->after('nama_tps');
            }

            if (!Schema::hasColumn('tps', 'status')) {
                $table->string('status')->default('bersih');
            }

            if (!Schema::hasColumn('tps', 'last_cleaned_at')) {
                $table->timestamp('last_cleaned_at')->nullable();
            }

            if (!Schema::hasColumn('tps', 'last_reported_at')) {
                $table->timestamp('last_reported_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tps', function (Blueprint $table) {
            $columns = [
                'lokasi',
                'status',
                'last_cleaned_at',
                'last_reported_at',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('tps', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
