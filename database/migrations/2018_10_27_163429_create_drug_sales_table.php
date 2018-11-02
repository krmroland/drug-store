<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drug_id')->unsigned()->index();
            $table->integer('sale_id')->unsigned()->index();
            $table->integer('quantity')->unsigned();
            $table->integer('unit_price')->unsigned();
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
        Schema::dropIfExists('drug_sales');
    }
}
