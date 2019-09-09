<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseMaterialPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_purchase', function (Blueprint $table) {
            $table->unsignedBigInteger('pu_id');
            $table->unsignedBigInteger('ma_id');
            $table->foreign('pu_id')->references('id')->on('purchases')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ma_id')->references('id')->on('materials')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['pu_id', 'ma_id']);
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
        Schema::dropIfExists('material_purchase');
    }
}
