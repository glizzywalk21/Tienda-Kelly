<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->enum('talla', ['35', '36', '37', '38', '39', '40', '41', '42', '43', '44'])->nullable();
            $table->string('imagen_referencia')->nullable();
            $table->string('estado')->default('Disponible');
            $table->unsignedBigInteger('fk_vendedors');
            $table->foreign('fk_vendedors')
                ->references('id')
                ->on('vendedors')
                ->onDelete('cascade');
        });

        // ========== Productos para Rosio (id=1) ==========
        DB::table('products')->insert([
            [
                'name' => 'Lasagna',
                'description' => 'Almuerzo de Lasagna con acompañamientos',
                'price' => 2.75,
                'talla' => null,
                'imagen_referencia' => 'lasagna.png',
                'estado' => 'Disponible',
                'fk_vendedors' => 1,
            ],
            [
                'name' => 'Pollo en Salsa',
                'description' => 'Pollo en salsa con acompañamientos',
                'price' => 2.75,
                'talla' => null,
                'imagen_referencia' => 'polloensalsa.png',
                'estado' => 'Disponible',
                'fk_vendedors' => 1,
            ],
            [
                'name' => 'Carne Guisada',
                'description' => 'Carne guisada con papas',
                'price' => 3.00,
                'talla' => null,
                'imagen_referencia' => 'Carne.jpg',
                'estado' => 'Disponible',
                'fk_vendedors' => 1,
            ],
        ]);

        // ========== Productos para Juan (id=2) - Electrodomésticos ==========
        DB::table('products')->insert([
            [
                'name' => 'Televisor LED 40"',
                'description' => 'Televisor LED de 40 pulgadas, resolución Full HD.',
                'price' => 280.00,
                'talla' => null,
                'imagen_referencia' => 'tv40.jpg',
                'estado' => 'Disponible',
                'fk_vendedors' => 2,
            ],
            [
                'name' => 'Refrigeradora 12 pies',
                'description' => 'Refrigeradora con congelador, capacidad de 12 pies cúbicos.',
                'price' => 450.00,
                'talla' => null,
                'imagen_referencia' => 'refrigeradora.jpg',
                'estado' => 'Disponible',
                'fk_vendedors' => 2,
            ],
            [
                'name' => 'Microondas',
                'description' => 'Microondas de 800W con funciones de descongelado.',
                'price' => 120.00,
                'talla' => null,
                'imagen_referencia' => 'micro.jpg',
                'estado' => 'Disponible',
                'fk_vendedors' => 2,
            ],
        ]);


        // ========== Productos para Carla (id=3) ==========
        DB::table('products')->insert([
            [
                'name' => 'Muñeca de Trapo',
                'description' => 'Muñeca de trapo hecha a mano',
                'price' => 10.00,
                'talla' => null,
                'imagen_referencia' => 'muneca.jpg',
                'estado' => 'Disponible',
                'fk_vendedors' => 3,
            ],
            [
                'name' => 'Carro de Juguete',
                'description' => 'Carro de juguete del rayo Mquenn metálico',
                'price' => 8.00,
                'talla' => null,
                'imagen_referencia' => 'mcqueen.jpg',
                'estado' => 'Disponible',
                'fk_vendedors' => 3,
            ],
            [
                'name' => 'Rompecabezas 500 piezas',
                'description' => 'Rompecabezas de 500 piezas',
                'price' => 15.00,
                'talla' => null,
                'imagen_referencia' => 'rompecabezas.jpg',
                'estado' => 'Disponible',
                'fk_vendedors' => 3,
            ],
        ]);

        // ========== Productos para Pedro (id=4) ==========
        DB::table('products')->insert([
            [
                'name' => 'Zapatos de vestir',
                'description' => 'Zapatos de vestir',
                'price' => 35.00,
                'talla' => null,
                'imagen_referencia' => 'zapatos_negros.png',
                'estado' => 'Disponible',
                'fk_vendedors' => 4,
            ],
            [
                'name' => 'Botas de Cuero',
                'description' => 'Botas de cuero resistentes',
                'price' => 55.00,
                'talla' => null,
                'imagen_referencia' => 'botas.jpg',
                'estado' => 'Disponible',
                'fk_vendedors' => 4,
            ],
            [
                'name' => 'Sandalias',
                'description' => 'Sandalias de verano talla 40',
                'price' => 20.00,
                'talla' => null,
                'imagen_referencia' => 'sandalias_verano.png',
                'estado' => 'Disponible',
                'fk_vendedors' => 4,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
