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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_releve');
            $table->enum('statut',['0','1','2'])->default('1'); //0 annulée; 1 non encaissée; 2 encaissée;
            $table->float('puissance_appelee');
            $table->float('cos_phi');
            $table->float('total_HT');
            $table->float('total_TVA');
            $table->float('total_TTC');
            $table->foreign('id_releve')->references('id')->on('releves');
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
        Schema::dropIfExists('factures');
    }
};
