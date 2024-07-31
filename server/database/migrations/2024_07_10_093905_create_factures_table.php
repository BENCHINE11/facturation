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
            $table->integer('mois')->nullable();
            $table->integer('annee')->nullable();

            $table->decimal('puissance_appelee', 15, 3);
            $table->decimal('cos_phi', 15, 2);
            $table->decimal('total_HT', 15, 2);
            $table->decimal('total_TVA', 15, 2);
            $table->decimal('total_TR', 15, 2);
            $table->decimal('total_TTC', 15, 2);
            
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