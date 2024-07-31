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
            $table->integer('mois')->default(1); // Nouvelle colonne pour le mois
            $table->integer('annee')->default(2024); // Nouvelle colonne pour l'année
            $table->decimal('index_mono1', 15, 2);
            $table->decimal('index_mono2', 15, 2);
            $table->decimal('index_mono3', 15, 2);
            $table->decimal('index_triJ', 15, 2);
            $table->decimal('index_triN', 15, 2);
            $table->decimal('index_triP', 15, 2);
            $table->decimal('index_reactif', 15, 2);
            $table->decimal('indicateur_max', 15, 2);
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