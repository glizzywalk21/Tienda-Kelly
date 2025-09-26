<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('carts')) return;

        if (Schema::hasColumn('carts', 'market_id')) {
            Schema::table('carts', function (Blueprint $table) {
                if (!Schema::hasColumn('carts', 'area_id')) {
                    $table->unsignedBigInteger('area_id')->nullable()->after('id');
                }
            });
            try { DB::statement('UPDATE carts SET area_id = market_id WHERE area_id IS NULL'); } catch (\Throwable $e) {}
            Schema::table('carts', function (Blueprint $table) {
                try { $table->dropForeign(['market_id']); } catch (\Throwable $e) {}
                try { $table->dropColumn('market_id'); } catch (\Throwable $e) {}
                try { $table->foreign('area_id')->references('id')->on('areas')->cascadeOnDelete(); } catch (\Throwable $e) {}
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('carts')) return;

        if (Schema::hasColumn('carts', 'area_id')) {
            Schema::table('carts', function (Blueprint $table) {
                try { $table->dropForeign(['area_id']); } catch (\Throwable $e) {}
                try { $table->dropColumn('area_id'); } catch (\Throwable $e) {}
                // $table->unsignedBigInteger('market_id')->nullable(); // si deseas revertir
            });
        }
    }
};
