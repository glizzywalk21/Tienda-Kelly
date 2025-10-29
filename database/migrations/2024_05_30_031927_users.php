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

        $usuarios = [
            [
                'ROL' => 4,
                'usuario' => 'jose.lopez@tiendakelly.sv',
                'password' => Hash::make('jose123'),
                'nombre' => 'José',
                'apellido' => 'López Martínez',
                'telefono' => '78451236',
                'sexo' => 'M'
            ],
            [
                'ROL' => 4,
                'usuario' => 'maria.reyes@tiendakelly.sv',
                'password' => Hash::make('maria456'),
                'nombre' => 'María',
                'apellido' => 'Reyes Gómez',
                'telefono' => '76984521',
                'sexo' => 'F'
            ],
            [
                'ROL' => 4,
                'usuario' => 'carlos.mendez@tiendakelly.sv',
                'password' => Hash::make('carlos789'),
                'nombre' => 'Carlos',
                'apellido' => 'Méndez Castillo',
                'telefono' => '71569384',
                'sexo' => 'M'
            ]
        ];

        foreach ($usuarios as $u) {
            DB::table('users')->insert($u);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
