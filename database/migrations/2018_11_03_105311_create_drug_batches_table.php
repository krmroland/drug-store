<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_batches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->date('recorded_at');
            $table->string('expires_at');
            $table->integer('unit_price')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->integer('drug_id')->unsigned()->index();
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
        Schema::dropIfExists('drug_batches');
    }
}
