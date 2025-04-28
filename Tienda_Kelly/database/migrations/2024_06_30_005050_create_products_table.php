<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
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
            $table->string('imagen_referencia')->nullable();
            $table->string('clasificacion');
            $table->string('estado')->default('Disponible');
            $table->unsignedBigInteger('fk_vendedors');
            $table->foreign('fk_vendedors')->references('id')->on('vendedors')->onDelete('cascade');
        });

        /**
         * COMEDOR ROSIO
         */
        // Insertar producto "Lasagna"
        DB::table('products')->insert([
            'name' => 'Lasagna',
            'description' => 'Almuerzo de Lasagna, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 2.75,
            'imagen_referencia' => 'lasagna.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'clasificacion' => 'comedor',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);DB::table('products')->insert([
            'name' => 'Pollo en Salsa',
            'description' => 'Almuerzo de Pollo en Salsa, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 2.75,
            'imagen_referencia' => 'polloensalsa.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'clasificacion' => 'comedor',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);DB::table('products')->insert([
            'name' => 'Carne Guisada',
            'description' => 'Almuerzo de Carne Guisada, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 3.00,
            'imagen_referencia' => 'carneguisada.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'clasificacion' => 'comedor',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);
        // Productos para el vendedor 1 del Mercado 1
DB::table('products')->insert([
    [
        'name' => 'Lasagna',
        'description' => 'Almuerzo de Lasagna, con dos acompañamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
        'price' => 2.75,
        'imagen_referencia' => 'lasagna.png',
        'clasificacion' => 'comedor',
        'estado' => 'Disponible',
        'fk_vendedors' => 1,  // Vendedor 1 del Mercado 1
    ],
    [
        'name' => 'Pizza Margarita',
        'description' => 'Pizza Margarita con salsa de tomate, mozzarella y albahaca.',
        'price' => 3.50,
        'imagen_referencia' => 'pizza_margarita.png',
        'clasificacion' => 'comedor',
        'estado' => 'Disponible',
        'fk_vendedors' => 1,
    ],
    [
        'name' => 'Ensalada Caesar',
        'description' => 'Ensalada Caesar con pollo, lechuga, crutones y aderezo Caesar.',
        'price' => 2.25,
        'imagen_referencia' => 'ensalada_caesar.png',
        'clasificacion' => 'comedor',
        'estado' => 'Disponible',
        'fk_vendedors' => 1,
    ],
]);

// Productos para el vendedor 2 del Mercado 1
DB::table('products')->insert([
    [
        'name' => 'Camisa Azul',
        'description' => 'Camisa de algodón azul, talla M.',
        'price' => 15.00,
        'imagen_referencia' => 'camisa_azul.png',
        'clasificacion' => 'ropa',
        'estado' => 'Disponible',
        'fk_vendedors' => 2,  // Vendedor 2 del Mercado 1
    ],
    [
        'name' => 'Zapatos Negros',
        'description' => 'Zapatos de cuero negro, talla 42.',
        'price' => 40.00,
        'imagen_referencia' => 'zapatos_negros.png',
        'clasificacion' => 'ropa',
        'estado' => 'Disponible',
        'fk_vendedors' => 2,
    ],
    [
        'name' => 'Sombrero Beige',
        'description' => 'Sombrero de paja beige, tamaño único.',
        'price' => 12.00,
        'imagen_referencia' => 'sombrero_beige.png',
        'clasificacion' => 'ropa',
        'estado' => 'Disponible',
        'fk_vendedors' => 2,
    ],
]);

// Productos para el vendedor 3 del Mercado 1
DB::table('products')->insert([
    [
        'name' => 'Cinta Métrica',
        'description' => 'Cinta métrica de 5 metros.',
        'price' => 8.00,
        'imagen_referencia' => 'cinta_metrica.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 3,  // Vendedor 3 del Mercado 1
    ],
    [
        'name' => 'Martillo',
        'description' => 'Martillo de acero con mango de madera.',
        'price' => 10.00,
        'imagen_referencia' => 'martillo.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 3,
    ],
    [
        'name' => 'Destornillador',
        'description' => 'Juego de destornilladores, incluye tamaños pequeños y grandes.',
        'price' => 6.00,
        'imagen_referencia' => 'destornillador.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 3,
    ],
]);

// Productos para el vendedor 1 del Mercado 2
DB::table('products')->insert([
    [
        'name' => 'Pan de Ajo',
        'description' => 'Pan recién horneado con ajo y perejil.',
        'price' => 1.50,
        'imagen_referencia' => 'pan_de_ajo.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 4,  // Vendedor 1 del Mercado 2
    ],
    [
        'name' => 'Croissant',
        'description' => 'Delicioso croissant de mantequilla.',
        'price' => 2.00,
        'imagen_referencia' => 'croissant.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 4,
    ],
    [
        'name' => 'Baguette',
        'description' => 'Baguette crujiente y dorada.',
        'price' => 1.75,
        'imagen_referencia' => 'baguette.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 4,
    ],
]);

// Productos para el vendedor 2 del Mercado 2
DB::table('products')->insert([
    [
        'name' => 'Sandalias Verano',
        'description' => 'Sandalias cómodas para verano, talla 38.',
        'price' => 25.00,
        'imagen_referencia' => 'sandalias_verano.png',
        'clasificacion' => 'ropa',
        'estado' => 'Disponible',
        'fk_vendedors' => 5,  // Vendedor 2 del Mercado 2
    ],
    [
        'name' => 'Cinturón Cuero',
        'description' => 'Cinturón de cuero negro, talla ajustable.',
        'price' => 20.00,
        'imagen_referencia' => 'cinturon_cuero.png',
        'clasificacion' => 'ropa',
        'estado' => 'Disponible',
        'fk_vendedors' => 5,
    ],
    [
        'name' => 'Bufanda Lana',
        'description' => 'Bufanda de lana para el invierno.',
        'price' => 15.00,
        'imagen_referencia' => 'bufanda_lana.png',
        'clasificacion' => 'ropa',
        'estado' => 'Disponible',
        'fk_vendedors' => 5,
    ],
]);

// Productos para el vendedor 3 del Mercado 2
DB::table('products')->insert([
    [
        'name' => 'Brocas para Taladro',
        'description' => 'Juego de brocas para taladro, diferentes tamaños.',
        'price' => 12.00,
        'imagen_referencia' => 'brocas_taladro.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 6,  // Vendedor 3 del Mercado 2
    ],
    [
        'name' => 'Sierra de Mano',
        'description' => 'Sierra de mano de alta calidad.',
        'price' => 18.00,
        'imagen_referencia' => 'sierra_mano.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 6,
    ],
    [
        'name' => 'Llave Inglesa',
        'description' => 'Llave inglesa ajustable.',
        'price' => 9.00,
        'imagen_referencia' => 'llave_inglesa.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 6,
    ],
]);

// Productos para el vendedor 1 del Mercado 3
DB::table('products')->insert([
    [
        'name' => 'Novela de Aventura',
        'description' => 'Una emocionante novela de aventuras.',
        'price' => 10.00,
        'imagen_referencia' => 'novela_aventura.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 7,  // Vendedor 1 del Mercado 3
    ],
    [
        'name' => 'Manual de Cocina',
        'description' => 'Manual de cocina con recetas tradicionales.',
        'price' => 15.00,
        'imagen_referencia' => 'manual_cocina.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 7,
    ],
    [
        'name' => 'Diccionario Inglés-Español',
        'description' => 'Diccionario completo inglés-español.',
        'price' => 20.00,
        'imagen_referencia' => 'diccionario.png',
        'clasificacion' => 'otros',
        'estado' => 'Disponible',
        'fk_vendedors' => 7,
    ],
]);

// Productos para el vendedor 2 del Mercado 3
DB::table('products')->insert([
    [
        'name' => 'Ensalada Mediterránea',
        'description' => 'Ensalada con aceite de oliva, aceitunas, y queso feta.',
        'price' => 3.00,
        'imagen_referencia' => 'ensalada_mediterranea.png',
        'clasificacion' => 'comedor',
        'estado' => 'Disponible',
        'fk_vendedors' => 8,  // Vendedor 2 del Mercado 3
    ],
    [
        'name' => 'Bocadillo Vegetariano',
        'description' => 'Bocadillo con vegetales frescos y hummus.',
        'price' => 2.50,
        'imagen_referencia' => 'bocadillo_vegetariano.png',
        'clasificacion' => 'comedor',
        'estado' => 'Disponible',
        'fk_vendedors' => 8,
    ],
    [
        'name' => 'Smoothie de Frutas',
        'description' => 'Smoothie fresco de frutas variadas.',
        'price' => 2.00,
        'imagen_referencia' => 'smoothie_frutas.png',
        'clasificacion' => 'comedor',
        'estado' => 'Disponible',
        'fk_vendedors' => 8,
    ],
]);

// Productos para el vendedor 3 del Mercado 3
DB::table('products')->insert([
    [
        'name' => 'Bolso de Mano',
        'description' => 'Bolso de mano elegante para mujeres.',
        'price' => 30.00,
        'imagen_referencia' => 'bolso_mano.png',
        'clasificacion' => 'emprendimiento',
        'estado' => 'Disponible',
        'fk_vendedors' => 9,  // Vendedor 3 del Mercado 3
    ],
    [
        'name' => 'Reloj de Pulsera',
        'description' => 'Reloj de pulsera clásico con correa de cuero.',
        'price' => 50.00,
        'imagen_referencia' => 'reloj_pulsera.png',
        'clasificacion' => 'emprendimiento',
        'estado' => 'Disponible',
        'fk_vendedors' => 9,
    ],
    [
        'name' => 'Gafas de Sol',
        'description' => 'Gafas de sol con protección UV.',
        'price' => 15.00,
        'imagen_referencia' => 'gafas_sol.png',
        'clasificacion' => 'emprendimiento',
        'estado' => 'Disponible',
        'fk_vendedors' => 9,
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
