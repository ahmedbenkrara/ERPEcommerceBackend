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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email');
            $table->string('title');
            $table->integer('rate');
            $table->text('message');
            $table->string('type');//module or package
            $table->unsignedBigInteger('modele_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
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
        Schema::dropIfExists('reviews');
    }
};
