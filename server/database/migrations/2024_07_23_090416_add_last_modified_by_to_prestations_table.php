<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastModifiedByToPrestationsTable extends Migration
{
    public function up()
    {
        Schema::table('prestations', function (Blueprint $table) {
            $table->string('last_modified_by')->nullable();
        });
    }

    public function down()
    {
        Schema::table('prestations', function (Blueprint $table) {
            $table->dropColumn('last_modified_by');
        });
    }
}
