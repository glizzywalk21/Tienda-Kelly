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
        Schema::create('reservation_items', function (Blueprint $table) {
            $table->id();
            //reservation
            $table->unsignedBigInteger('fk_reservation');
            //product anclado
           $table->unsignedBigInteger('fk_product');
           $table->unsignedBigInteger('fk_vendedors');
           $table->unsignedBigInteger('fk_mercados');

           $table->string('nombre')->nullable();
           $table->decimal('precio', 8, 2);
           $table->integer('quantity');
           $table->decimal('subtotal', 8,2)->default(1);
            $table->foreign('fk_vendedors')->references('id')->on('vendedors')->onDelete('cascade');
           $table->foreign('fk_reservation')->references('id')->on('reservations')->onDelete('cascade');
           $table->foreign('fk_product')->references('id')->on('products')->onDelete('cascade');
           $table->foreign('fk_mercados')->references('id')->on('mercado_locals')->onDelete('cascade');


           $table->string('estado')->default("enviado");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_items');
    }
};
