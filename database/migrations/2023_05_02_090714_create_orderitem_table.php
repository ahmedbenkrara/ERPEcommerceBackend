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
        Schema::create('orderitem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('modele_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->integer('quantity');
            $table->string('type');
            $table->foreign('order_id')->references('id')->on('order');
            $table->foreign('modele_id')->references('id')->on('modele');
            $table->foreign('package_id')->references('id')->on('package');
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
        Schema::dropIfExists('orderitem');
    }
};
