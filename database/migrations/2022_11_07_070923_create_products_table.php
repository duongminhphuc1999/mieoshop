<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 254)->require();
            $table->string('slug', 254)->require();
            $table->unsignedInteger('meta_id')->require();
            $table->unsignedInteger('price', 254);
            $table->unsignedInteger('sale_price', 254);
            $table->string('main_image', 254)->nullable();
            $table->unsignedInteger('images')->nullable();
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
        Schema::dropIfExists('products');
    }
};
