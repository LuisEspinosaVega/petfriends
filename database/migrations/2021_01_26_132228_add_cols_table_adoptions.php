<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsTableAdoptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adoptions', function (Blueprint $table) {
            $table->text('vaccines');
            $table->boolean('sterilized')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adoptions', function (Blueprint $table) {
            $table->dropColumn('vaccines');
            $table->dropColumn('sterilized');
        });
    }
}
