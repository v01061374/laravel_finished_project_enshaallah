<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToPurchasePivotsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_purchase', function (Blueprint $table) {
            $table->boolean('stocked');
        });
        Schema::table('material_purchase', function (Blueprint $table) {
            $table->boolean('stocked');
        });
        Schema::table('purchase_tool', function (Blueprint $table) {
            $table->boolean('stocked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
