<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Insertar usuarios de ejemplo con diferentes roles
        DB::table('users')->insert([
            [
                'ROL' => 1,
                'usuario' => 'admin@tiendakelly.sv',
                'password' => Hash::make('tiendakelly'),
                'nombre' => 'Administrador',
                'apellido' => 'De MiniShop',
                'telefono' => null,
                'sexo' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ROL' => 2,
                'usuario' => 'admin_mercado@tiendakelly.sv',
                'password' => Hash::make('adminmercado1'),
                'nombre' => 'Admin',
                'apellido' => 'Mercado',
                'telefono' => null,
                'sexo' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ROL' => 3,
                'usuario' => 'vendedor@tiendakelly.sv',
                'password' => Hash::make('vendedor1'),
                'nombre' => 'Vendedor',
                'apellido' => 'De Mercado',
                'telefono' => null,
                'sexo' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}