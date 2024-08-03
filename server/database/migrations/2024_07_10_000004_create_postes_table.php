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
        Schema::create('postes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_port');
            $table->unsignedBigInteger('id_client');
            $table->string('ref_poste')->unique();
            $table->float('puissance_souscrite');
            $table->float('puissance_installee');          
            $table->float('caution');
            $table->float('min_garanti');
            $table->foreign('id_port')->references('id')->on('ports');
            $table->foreign('id_client')->references('id')->on('clients');
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
        Schema::dropIfExists('postes');
    }
};
