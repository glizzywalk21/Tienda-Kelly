<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mercado_locals', function (Blueprint $table) {
            $table->id();
            $table->string('usuario');
            $table->string('password');
            $table->string('nombre');
            $table->unsignedTinyInteger('ROL')->nullable()->default(2);
            $table->string('imagen_referencia')->nullable();
            $table->text('descripcion');
            $table->timestamps();
        });

        // =======================
        // Puesto: Comedor
        // =======================
        $password = 'Comedor1';
        $hash = Hash::make($password);

        DB::insert('insert into mercado_locals (
            id,
            usuario,
            password,
            nombre,
            ROL,
            imagen_referencia,
            descripcion,
            created_at,
            updated_at
        ) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            1,
            'comedor@tiendakelly.sv',
            $hash,
            'Comedor',
            2,
            'comedor.jpg',
            'El comedor ofrece un espacio acogedor donde se brinda alimentación equilibrada y de calidad. Se preparan diariamente platillos variados elaborados con ingredientes frescos y nutritivos, priorizando productos locales y de temporada. El objetivo principal es ofrecer un servicio que promueva el bienestar y una buena nutrición para todos los comensales.',
            now(),
            now()
        ]);

        // =======================
        // Puesto: Electrodomésticos
        // =======================
        $password = 'Electrodomesticos1';
        $hash = Hash::make($password);

        DB::insert('insert into mercado_locals (
            id,
            usuario,
            password,
            nombre,
            ROL,
            imagen_referencia,
            descripcion,
            created_at,
            updated_at
        ) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            2,
            'electro@tiendakelly.sv',
            $hash,
            'Electrodomésticos',
            2,
            'electro.jpg',
            'El puesto de Electrodomésticos es un lugar ideal para encontrar una amplia variedad de productos electrónicos y electrodomésticos, desde televisores y refrigeradores hasta pequeños aparatos de cocina.',
            now(),
            now()
        ]);

        // =======================
        // Puesto: Juguetes
        // =======================
        $password = 'Juguetes1';
        $hash = Hash::make($password);

        DB::insert('insert into mercado_locals (
            id,
            usuario,
            password,
            nombre,
            ROL,
            imagen_referencia,
            descripcion,
            created_at,
            updated_at
        ) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            3,
            'juguetes@tiendakelly.sv',
            $hash,
            'Juguetes',
            2,
            'juguetes.jpg',
            'El puesto de Juguetes es un espacio lleno de diversión y color, donde los niños encuentran muñecos, carros, peluches y juegos didácticos que estimulan la imaginación.',
            now(),
            now()
        ]);

        // =======================
        // Puesto: Zapatos
        // =======================
        $password = 'Zapatos1';
        $hash = Hash::make($password);

        DB::insert('insert into mercado_locals (
            id,
            usuario,
            password,
            nombre,
            ROL,
            imagen_referencia,
            descripcion,
            created_at,
            updated_at
        ) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            4,
            'zapatos@tiendakelly.sv',
            $hash,
            'Zapatos',
            2,
            'zapateria.jpg',
            'El puesto de Zapatos es reconocido por su gran variedad de calzado para toda la familia, desde zapatos formales hasta deportivos, siempre con diseños modernos y precios accesibles.',
            now(),
            now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mercado_locals');
    }
};