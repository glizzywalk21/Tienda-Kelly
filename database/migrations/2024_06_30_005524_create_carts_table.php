<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_product');
            $table->foreign('fk_product')->references('id')->on('products')->onDelete('cascade');
            $table->integer('quantity')->nulleable()->default(1);
            $table->double('subtotal')->nulleable()->default(0.01);
            $table->timestamps();
            $table->unsignedBigInteger('fk_user');
            $table -> foreign('fk_user') -> references('id') -> on('users') -> onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
