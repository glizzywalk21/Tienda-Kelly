<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('markets')) {
            Schema::rename('markets', 'areas');
        } elseif (Schema::hasTable('mercados')) {
            Schema::rename('mercados', 'areas');
        } elseif (Schema::hasTable('mercado_locals')) {
            Schema::rename('mercado_locals', 'areas');
        } elseif (Schema::hasTable('mercado_locales')) {
            Schema::rename('mercado_locales', 'areas');
        }

        if (Schema::hasTable('areas') && !Schema::hasColumn('areas', 'slug')) {
            Schema::table('areas', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name');
            });
            try {
                DB::table('areas')->update([ 'slug' => DB::raw("LOWER(REPLACE(name, ' ', '-'))") ]);
            } catch (\Throwable $e) {
                // Ignorar si falla por motor distinto
            }
        }
    }

    public function down(): void
    {
        // Si originalmente era 'markets', volver atrás
        if (Schema::hasTable('areas') && !Schema::hasTable('markets')) {
            Schema::rename('areas', 'markets');
        }
    }
};
