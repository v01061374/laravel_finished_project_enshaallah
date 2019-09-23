<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('acceptance_date');
            $table->date('expectation_date');
            $table->unsignedBigInteger('stock_id');
            $table->foreign('stock_id')->references('id')->on('digistocks')
                ->onUpdate('cascade');
            $table->integer('elapsed_time');
            $table->integer('cost');
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
        Schema::dropIfExists('packages');
    }
}
