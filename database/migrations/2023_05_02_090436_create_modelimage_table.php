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
        Schema::create('modelimage', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->integer('isposter');
            $table->unsignedBigInteger('modele_id');
            $table->foreign('modele_id')->references('id')->on('modele');
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
        Schema::dropIfExists('modelimage');
    }
};
