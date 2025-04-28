<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->decimal('total');
            //Usuario perteneciente
            $table->unsignedBigInteger('fk_user');

            $table->foreign('fk_user')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
          
            $table->string('estado')->default("enviado");
            $table->string('retiro')->default("Entrada del Mercado");
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
