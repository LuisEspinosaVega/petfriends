<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arequests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('adoption_id')->index();
            $table->unsignedBigInteger('user_id');
            $table->integer('age');
            $table->integer('members');
            $table->string('agree');
            $table->string('more');
            $table->string('many')->nullable();
            $table->text('space');
            $table->text('data');
            $table->text('why');
            $table->string('status')->default('Solicitado');
            $table->boolean('accept');
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
        Schema::dropIfExists('arequests');
    }
}
