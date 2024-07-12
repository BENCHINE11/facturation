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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('ref_client')->unique();
            $table->string('CIN')->nullable()->unique();
            $table->string('ICE')->nullable()->unique();
            $table->string('raison_sociale')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->smallInteger('caution');
            $table->string('min_garantie');
            $table->enum('etat',['0','1']);
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
        Schema::dropIfExists('clients');
    }
};
