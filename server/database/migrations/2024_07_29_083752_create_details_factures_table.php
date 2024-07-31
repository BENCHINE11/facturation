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
        Schema::create('details_factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_facture');

            $table->decimal('quantite', 15, 2);
            $table->decimal('montant_ht', 15, 2);
            $table->decimal('montant_tva', 15, 2);
            $table->decimal('ancien_index', 15);
            $table->decimal('nouvel_index', 15);
            $table->integer('code_prestation');

            $table->foreign('id_facture')->references('id')->on('factures')->onDelete('cascade');
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
        Schema::dropIfExists('details_factures');
    }
};