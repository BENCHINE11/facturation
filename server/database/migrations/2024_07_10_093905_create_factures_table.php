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
            $table->unsignedBigInteger('id_poste');
            $table->enum('statut',['0','1','2'])->default('1'); //0 annulée; 1 non encaissée; 2 encaissée;
            
            $table->integer('mois')->nullable();
            $table->integer('annee')->nullable();
            $table->double('consommation_jour')->nullable();
            $table->double('consommation_nuit')->nullable();
            $table->double('consommation_pointe')->nullable();
            $table->double('consommation_reactif')->nullable();
            $table->double('pa')->nullable();

            $table->double('e_active_jour_actuel')->nullable();
            $table->double('e_active_nuit_actuel')->nullable();
            $table->double('e_active_pointe_actuel')->nullable();

            $table->double('e_active_jour_ancien')->nullable();
            $table->double('e_active_nuit_ancien')->nullable();
            $table->double('e_active_pointe_ancien')->nullable();

            $table->double('rdps')->nullable();

            $table->double('eaj_actuel')->nullable();
            $table->double('ean_actuel')->nullable();
            $table->double('eap_actuel')->nullable();

            $table->double('eaj_ancien')->nullable();
            $table->double('ean_ancien')->nullable();
            $table->double('eap_ancien')->nullable();

            $table->double('v')->nullable();
            $table->float('cos_phi');

            $table->float('total_HT');
            $table->float('total_TVA');
            $table->float('total_TR');
            $table->float('total_TTC');

            $table->foreign('id_releve')->references('id')->on('releves');
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
        Schema::dropIfExists('factures');
    }
};
