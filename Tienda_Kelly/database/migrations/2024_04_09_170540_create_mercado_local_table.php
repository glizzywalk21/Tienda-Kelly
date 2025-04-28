    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



return new class extends Migration
{
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
            $table->double('ROL')->unsigned()->nullable()->default(2);
            $table->string('imagen_referencia')->nullable();
            $table->string('municipio');
            $table->string('ubicacion');
            $table->time('horaentrada');
            $table->time('horasalida');
            $table->text('descripcion');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

        });
        //MERCADO CENTRAL
        $password = 'MercadoCentral1';
        $hash = Hash::make($password);

        DB::insert('insert into mercado_locals (
            id,
            usuario,
            password,
            nombre,
            ROL,
            imagen_referencia,
            municipio,
            ubicacion,
            horaentrada,
            horasalida,
            descripcion,
            created_at,
            updated_at)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            1,
            'MercadoCentral@minishop.sv',
            $hash,
            'Mercado Central',
            2,
            'mercadocentral.png',
            'San Salvador Centro',
            '3av norte y 1a calle poniente, san salvador centro',
            '085000',
            '203000',
            'El mercado central es uno de los principales mercados de San Salvador, se pueden encontrar diversos productos',
            now(),
            now()
        ]);

        /**
         * MEERCADO HULA HULA
         */
        $password = 'MercadoHulaHula1';
        $hash = Hash::make($password);

        DB::insert('insert into mercado_locals (
            id,
            usuario,
            password,
            nombre,
            ROL,
            imagen_referencia,
            municipio,
            ubicacion,
            horaentrada,
            horasalida,
            descripcion,
            created_at,
            updated_at)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            2,
            'MercadoHulaHula@minishop.sv',
            $hash,
            'Mercado Hula Hula',
            2,
            'mercadohulahula.png',
            'San Salvador Centro',
            'Calle Ruben Dario &, 3 Avenida Sur, San Salvador',
            '085000',
            '203000',
            'El Mercado Hula Hula en San Salvador es un bullicioso centro de comercio conocido por su diversidad de productos, desde alimentos frescos hasta ropa y electrónica, y su ambiente vibrante que refleja la cultura local',
            now(),
            now()
        ]);
        /**
         * MEERCADO Sagrado Corazon
         */
        $password = 'MercadoLaTiendona1';
        $hash = Hash::make($password);

        DB::insert('insert into mercado_locals (
            id,
            usuario,
            password,
            nombre,
            ROL,
            imagen_referencia,
            municipio,
            ubicacion,
            horaentrada,
            horasalida,
            descripcion,
            created_at,
            updated_at)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            3,
            'MercadoLaTiendona@minishop.sv',
            $hash,
            'Mercado La Tiendona',
            2,
            'mercadolatiendona.png',
            'San Salvador Centro',
            '24a Avenida Norte, San Salvador',
            '085000',
            '203000',
            'El Mercado La Tiendona en San Salvador es un vibrante centro de abastos mayorista, famoso por su amplia oferta de frutas, verduras, carnes y productos frescos. Es un lugar esencial para abastecer negocios locales',
            now(),
            now()
        ]);
        /**
         * MEERCADO EX CUARTEL
         */
        $password = 'MercadoExCuartel1';
        $hash = Hash::make($password);

        DB::insert('insert into mercado_locals (
            id,
            usuario,
            password,
            nombre,
            ROL,
            imagen_referencia,
            municipio,
            ubicacion,
            horaentrada,
            horasalida,
            descripcion,
            created_at,
            updated_at)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            4,
            'MercadoExCuartel@minishop.sv',
            $hash,
            'Mercado Ex-Cuartel',
            2,
            'mercadoex-cuartel.png',
            'San Salvador Centro',
            '1a Calle Ote. &, 8a Avenida Norte, San Salvador',
            '085000',
            '203000',
            'El Mercado Excuartel en San Salvador es un punto comercial vibrante, ubicado en un antiguo cuartel militar. Ofrece una amplia variedad de productos, especialmente ropa y calzado, en un entorno lleno de historia y cultura local',
            now(),
            now()
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mercado_local');
    }
};
