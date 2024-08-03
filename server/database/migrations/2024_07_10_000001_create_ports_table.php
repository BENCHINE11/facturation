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
        Schema::create('ports', function (Blueprint $table) {
            $table->id();
            $table->string('code_port')->unique();
            $table->string('libelle_port');
            $table->unsignedBigInteger('id_region');
<<<<<<< HEAD
            $table->foreign('id_region')->references('id')->on('regions');
=======
            $table->foreign('id_region')->references('id')->on('regions')->dele;
>>>>>>> 4a183037c4efa66b878a706948b0260607ed0c1a
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
        Schema::dropIfExists('ports');
    }
};
