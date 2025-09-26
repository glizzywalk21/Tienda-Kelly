<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Normalizar tabla products si está en español
        if (!Schema::hasTable('products') && Schema::hasTable('productos')) {
            Schema::rename('productos', 'products');
        }
        if (!Schema::hasTable('products')) return;

        // Caso A: ya existe vendor_id -> solo asegurar FK si falta
        if (Schema::hasColumn('products', 'vendor_id')) {
            Schema::table('products', function (Blueprint $table) {
                try { $table->foreign('vendor_id')->references('id')->on('vendors')->cascadeOnDelete(); } catch (\Throwable $e) {}
            });
            return;
        }

        // Caso B: convertir market_id -> area_id
        if (Schema::hasColumn('products', 'market_id')) {
            Schema::table('products', function (Blueprint $table) {
                if (!Schema::hasColumn('products', 'area_id')) {
                    $table->unsignedBigInteger('area_id')->nullable()->after('id');
                }
            });
            try { DB::statement('UPDATE products SET area_id = market_id WHERE area_id IS NULL'); } catch (\Throwable $e) {}
            Schema::table('products', function (Blueprint $table) {
                try { $table->dropForeign(['market_id']); } catch (\Throwable $e) {}
                try { $table->dropColumn('market_id'); } catch (\Throwable $e) {}
                try { $table->foreign('area_id')->references('id')->on('areas')->cascadeOnDelete(); } catch (\Throwable $e) {}
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('products')) return;
        if (Schema::hasColumn('products', 'area_id')) {
            Schema::table('products', function (Blueprint $table) {
                try { $table->dropForeign(['area_id']); } catch (\Throwable $e) {}
                try { $table->dropColumn('area_id'); } catch (\Throwable $e) {}
                // $table->unsignedBigInteger('market_id')->nullable(); // si deseas revertir
            });
        }
    }
};
