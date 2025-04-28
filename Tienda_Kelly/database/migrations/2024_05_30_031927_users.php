<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedDouble('ROL')->nullable()->default(4);
            $table->string('imagen_perfil')->nullable()->default("non-img.png");
            $table->string('usuario')->unique();
            $table->string('password');
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('telefono')->nullable();
            $table->string('sexo')->nullable();
            $table->timestamps();
            $table->rememberToken();
        });

        // Agregar un usuario admin general por defecto
        $password = 'minishop1';
        $hash = Hash::make($password);
        DB::insert('insert into users (id, ROL, usuario, password, nombre, apellido, telefono, sexo) values (?, ?, ?, ?, ?, ?, ?, ?)', [1, 1, 'admin@minishop.sv', $hash, 'Administrador', 'De MiniShop', NULL, NULL]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

