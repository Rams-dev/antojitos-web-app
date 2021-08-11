<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_ventas', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("venta_id");
            $table->string("product_name");
            $table->integer("amount");
            $table->integer("price");
            $table->integer("price_total");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_ventas');
    }
}
