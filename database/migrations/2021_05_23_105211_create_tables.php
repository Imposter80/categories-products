<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('categoryname', 128)->unique();
            $table->string('categorydescription', 256);
            $table->timestamps();
        });

        Schema::create('Products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoryid');
            $table->foreign('categoryid')->references('id')->on('Categories')->onDelete('cascade'); //при удалении категории, удаляем все связанные товары
            $table->string('productname', 128)->unique();
            $table->longText('productdescription');
            $table->float('price')->nullable(); // допускаем отсутствие цены товара
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
        Schema::drop('Categories');
        Schema::drop('Products');
    }
}
























