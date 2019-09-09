<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockMaterialPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_stock', function (Blueprint $table) {
            $table->unsignedBigInteger('st_id');
            $table->unsignedBigInteger('ma_id');
            $table->foreign('st_id')->references('id')->on('stocks')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ma_id')->references('id')->on('materials')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['st_id', 'ma_id']);
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
        Schema::dropIfExists('material_stock');
    }
}
