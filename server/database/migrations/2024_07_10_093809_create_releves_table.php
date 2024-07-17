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
        Schema::create('releves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_poste');
            $table->string('periode_consommation');
            $table->float('index_mono1');
            $table->float('index_mono2');
            $table->float('index_mono3');
            $table->float('index_triJ');
            $table->float('index_triN');
            $table->float('index_triP');
            $table->float('index_reactif');
            $table->float('indicateur_max');
            $table->foreign('id_poste')->references('id')->on('postes');
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
        Schema::dropIfExists('releves');
    }
};
