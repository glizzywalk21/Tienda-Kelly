<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendedors', function (Blueprint $table) {
            $table->id();
            $table->string('usuario')->unique();
            $table->unsignedTinyInteger('ROL')->default(3);
            $table->string('password');
            $table->string('nombre');
            $table->string('nombre_del_local')->nullable();
            $table->string('imagen_de_referencia');
            $table->string('apellidos')->nullable();
            $table->string('telefono')->nullable();
            $table->string('numero_puesto', 10)->unique();
            $table->string('clasificacion')->nullable();
            $table->unsignedBigInteger('fk_mercado');
            $table->foreign('fk_mercado')
                  ->references('id')
                  ->on('mercado_locals')
                  ->onDelete('cascade');
            $table->timestamps();
        });

        // ===================
        // Seeds iniciales
        // ===================

        // Rosio - Comedor
        DB::table('vendedors')->insert([
            'usuario' => 'rocio.martinez@gmail.com',
            'ROL' => 3,
            'password' => Hash::make('12345678'),
            'nombre' => 'Rocio',
            'apellidos' => 'Martinez',
            'nombre_del_local' => 'Comedor Rocio',
            'imagen_de_referencia' => 'rosiomartinez.png',
            'telefono' => '75469651',
            'numero_puesto' => '1',
            'fk_mercado' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Juan - Electrodomésticos
        DB::table('vendedors')->insert([
            'usuario' => 'juan.perez@gmail.com',
            'ROL' => 3,
            'password' => Hash::make('12345678'),
            'nombre' => 'Juan',
            'apellidos' => 'Pérez',
            'nombre_del_local' => 'Electrodomésticos',
            'imagen_de_referencia' => '20220045.jpg',
            'telefono' => '75412345',
            'numero_puesto' => '2',
            'fk_mercado' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Carla - Juguetería
        DB::table('vendedors')->insert([
            'usuario' => 'carla.mendez@gmail.com',
            'ROL' => 3,
            'password' => Hash::make('12345678'),
            'nombre' => 'Carla',
            'apellidos' => 'Méndez',
            'nombre_del_local' => 'Juguetería',
            'imagen_de_referencia' => 'carlamendez.png',
            'telefono' => '75478901',
            'numero_puesto' => '3',
            'fk_mercado' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pedro - Zapatos
        DB::table('vendedors')->insert([
            'usuario' => 'pedro.rodriguez@gmail.com',
            'ROL' => 3,
            'password' => Hash::make('12345678'),
            'nombre' => 'Pedro',
            'apellidos' => 'Rodríguez',
            'nombre_del_local' => 'Zapatería Pedro',
            'imagen_de_referencia' => 'pedrorodriguez.png',
            'telefono' => '75456789',
            'numero_puesto' => '4',
            'fk_mercado' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedors');
    }
};