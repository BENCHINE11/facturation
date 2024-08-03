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
        Schema::table('factures', function (Blueprint $table) {
            $table->string('cree_par')->nullable()->after('total_TTC');
            $table->string('annulee_par')->nullable()->after('cree_par');
            $table->string('reglee_par')->nullable()->after('annulee_par');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('factures', function (Blueprint $table) {
            $table->dropColumn(['cree_par', 'annulee_par', 'reglee_par']);
        });
    }
};

