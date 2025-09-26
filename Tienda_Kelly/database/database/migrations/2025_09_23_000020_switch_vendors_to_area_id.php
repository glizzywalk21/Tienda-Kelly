<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Normalizar nombre de tabla a 'vendors'
        if (!Schema::hasTable('vendors')) {
            if (Schema::hasTable('vendedores')) {
                Schema::rename('vendedores', 'vendors');
            } elseif (Schema::hasTable('vendedor')) {
                Schema::rename('vendedor', 'vendors');
            }
        }
        if (!Schema::hasTable('vendors')) return;

        // Agregar area_id (nullable al inicio para poder poblar)
        Schema::table('vendors', function (Blueprint $table) {
            if (!Schema::hasColumn('vendors', 'area_id')) {
                $table->unsignedBigInteger('area_id')->nullable()->after('id');
            }
        });

        // Si existe market_id, migrarlo a area_id
        if (Schema::hasColumn('vendors', 'market_id')) {
            try { DB::statement('UPDATE vendors SET area_id = market_id WHERE area_id IS NULL'); } catch (\Throwable $e) {}
            Schema::table('vendors', function (Blueprint $table) {
                try { $table->dropForeign(['market_id']); } catch (\Throwable $e) {}
                try { $table->dropColumn('market_id'); } catch (\Throwable $e) {}
            });
        }

        // Si existe fk_mercado (de tu plantilla), migrarlo a area_id y eliminarlo
        if (Schema::hasColumn('vendors', 'fk_mercado')) {
            try { DB::statement('UPDATE vendors SET area_id = fk_mercado WHERE area_id IS NULL'); } catch (\Throwable $e) {}
            Schema::table('vendors', function (Blueprint $table) {
                try { $table->dropForeign(['fk_mercado']); } catch (\Throwable $e) {}
                try { $table->dropColumn('fk_mercado'); } catch (\Throwable $e) {}
            });
        }

        // Crear FK hacia areas
        if (Schema::hasTable('areas')) {
            Schema::table('vendors', function (Blueprint $table) {
                try { $table->foreign('area_id')->references('id')->on('areas')->cascadeOnDelete(); } catch (\Throwable $e) {}
            });
        }

        // Forzar 1 vendedor por área
        try { DB::statement('ALTER TABLE vendors MODIFY area_id BIGINT UNSIGNED NOT NULL'); } catch (\Throwable $e) {}
        try { DB::statement('CREATE UNIQUE INDEX vendors_area_unique ON vendors (area_id)'); } catch (\Throwable $e) {}

        // Ajustes opcionales de tipos (evitar DOUBLE en teléfono/puesto)
        try { DB::statement("ALTER TABLE vendors MODIFY telefono VARCHAR(20) NULL"); } catch (\Throwable $e) {}
        try { DB::statement("ALTER TABLE vendors MODIFY numero_puesto INT UNSIGNED"); } catch (\Throwable $e) {}

        // Índice único sugerido para usuario
        if (Schema::hasColumn('vendors', 'usuario')) {
            try { DB::statement("CREATE UNIQUE INDEX vendors_usuario_unique ON vendors (usuario)"); } catch (\Throwable $e) {}
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('vendors')) return;

        try { DB::statement('DROP INDEX vendors_area_unique ON vendors'); } catch (\Throwable $e) {}
        if (Schema::hasColumn('vendors', 'usuario')) {
            try { DB::statement('DROP INDEX vendors_usuario_unique ON vendors'); } catch (\Throwable $e) {}
        }
        Schema::table('vendors', function (Blueprint $table) {
            try { $table->dropForeign(['area_id']); } catch (\Throwable $e) {}
            try { $table->dropColumn('area_id'); } catch (\Throwable $e) {}
        });

        // No renombro de vuelta a 'vendedor' para no perder datos.
    }
};
