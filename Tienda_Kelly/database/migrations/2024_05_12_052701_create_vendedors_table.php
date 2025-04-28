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
            $table->unsignedDouble('ROL')->nullable()->default(3);
            $table->string('password');
            $table->string('nombre');
            $table->string('nombre_del_local')->nullable();
            $table->string('imagen_de_referencia');
            $table->string('clasificacion')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('telefono')->nullable();
            $table->integer('numero_puesto')->unique();
            $table->unsignedBigInteger('fk_mercado');
            $table->foreign('fk_mercado')->references('id')->on('mercado_locals')->onDelete('cascade');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

        });

        DB::table('vendedors')->insert([
            'usuario' => 'rosio.martinez@gmail.com',
            'ROL' => 3,
            'password' => Hash::make('12345678'), // Ajusta la contraseña según tus necesidades
            'nombre' => 'Rosio',
            'nombre_del_local' => 'Comedor Rosio',
            'imagen_de_referencia' => 'rosiomartinez.png', // Valor por defecto null
            'clasificacion' => 'comedor', // Valor por defecto null
            'apellidos' => 'Martinez',
            'telefono' => '75469651', // Valor por defecto null
            'numero_puesto' => '001', // Valor por defecto null
            'fk_mercado' => 1, // Ajusta esto según el ID de un mercado local existente
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('vendedors')->insert([
            // Vendedores para el Mercado 1
            [
                'usuario' => 'juan.perez@gmail.com',
                'ROL' => 3,
                'password' => Hash::make('12345678'),
                'nombre' => 'Juan',
                'nombre_del_local' => 'Tienda Juanito',
                'imagen_de_referencia' => 'juanperez.png',
                'clasificacion' => 'emprendimiento',
                'apellidos' => 'Pérez',
                'telefono' => '75412345',
                'numero_puesto' => '002',
                'fk_mercado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usuario' => 'maria.gonzalez@gmail.com',
                'ROL' => 3,
                'password' => Hash::make('12345678'),
                'nombre' => 'María',
                'nombre_del_local' => 'Boutique María',
                'imagen_de_referencia' => 'mariagonzalez.png',
                'clasificacion' => 'emprendimiento',
                'apellidos' => 'González',
                'telefono' => '75467890',
                'numero_puesto' => '003',
                'fk_mercado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Vendedores para el Mercado 2
            [
                'usuario' => 'pedro.rodriguez@gmail.com',
                'ROL' => 3,
                'password' => Hash::make('12345678'),
                'nombre' => 'Pedro',
                'nombre_del_local' => 'Panadería Pedro',
                'imagen_de_referencia' => 'pedrorodriguez.png',
                'clasificacion' => 'otros',
                'apellidos' => 'Rodríguez',
                'telefono' => '75423456',
                'numero_puesto' => '004',
                'fk_mercado' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usuario' => 'laura.silva@gmail.com',
                'ROL' => 3,
                'password' => Hash::make('12345678'),
                'nombre' => 'Laura',
                'nombre_del_local' => 'Zapatería Laura',
                'imagen_de_referencia' => 'laurasilva.png',
                'clasificacion' => 'emprendimiento',
                'apellidos' => 'Silva',
                'telefono' => '75434567',
                'numero_puesto' => '005',
                'fk_mercado' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usuario' => 'oscar.morales@gmail.com',
                'ROL' => 3,
                'password' => Hash::make('12345678'),
                'nombre' => 'Óscar',
                'nombre_del_local' => 'Ferretería Óscar',
                'imagen_de_referencia' => 'oscarmorales.png',
                'clasificacion' => 'otros',
                'apellidos' => 'Morales',
                'telefono' => '75445678',
                'numero_puesto' => '006',
                'fk_mercado' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Vendedores para el Mercado 3
            [
                'usuario' => 'claudia.fernandez@gmail.com',
                'ROL' => 3,
                'password' => Hash::make('12345678'),
                'nombre' => 'Claudia',
                'nombre_del_local' => 'Librería Claudia',
                'imagen_de_referencia' => 'claudiafernandez.png',
                'clasificacion' => 'otros',
                'apellidos' => 'Fernández',
                'telefono' => '75456789',
                'numero_puesto' => '007',
                'fk_mercado' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usuario' => 'manuel.ortiz@gmail.com',
                'ROL' => 3,
                'password' => Hash::make('12345678'),
                'nombre' => 'Manuel',
                'nombre_del_local' => 'Restaurante Manuel',
                'imagen_de_referencia' => 'manuelortiz.png',
                'clasificacion' => 'comedor',
                'apellidos' => 'Ortiz',
                'telefono' => '75467891',
                'numero_puesto' => '008',
                'fk_mercado' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usuario' => 'carla.mendez@gmail.com',
                'ROL' => 3,
                'password' => Hash::make('12345678'),
                'nombre' => 'Carla',
                'nombre_del_local' => 'Juguetería Carla',
                'imagen_de_referencia' => 'carlamendez.png',
                'clasificacion' => 'plasticos',
                'apellidos' => 'Méndez',
                'telefono' => '75478901',
                'numero_puesto' => '009',
                'fk_mercado' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
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

