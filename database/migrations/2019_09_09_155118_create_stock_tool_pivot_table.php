<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockToolPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_tool', function (Blueprint $table) {
            $table->unsignedBigInteger('st_id');
            $table->unsignedBigInteger('to_id');
            $table->foreign('st_id')->references('id')->on('stocks')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('to_id')->references('id')->on('tools')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['st_id', 'to_id']);
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
        Schema::dropIfExists('stock_tool');
    }
}
