<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseToolPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_tool', function (Blueprint $table) {
            $table->unsignedBigInteger('pu_id');
            $table->unsignedBigInteger('to_id');
            $table->foreign('pu_id')->references('id')->on('purchases');
            $table->foreign('to_id')->references('id')->on('tools');
            $table->primary(['pu_id', 'to_id']);
            $table->integer('unit_price');
            $table->integer('qty');
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
        Schema::dropIfExists('purchase_tool');
    }
}
