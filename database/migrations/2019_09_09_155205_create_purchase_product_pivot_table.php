<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseProductPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchase', function (Blueprint $table) {
            $table->unsignedBigInteger('pu_id');
            $table->unsignedBigInteger('pr_id');
            $table->foreign('pu_id')->references('id')->on('purchases')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pr_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['pu_id', 'pr_id']);
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
        Schema::dropIfExists('product_purchase');
    }
}
