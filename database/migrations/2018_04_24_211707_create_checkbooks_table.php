<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('associated_id')->unsigned();
            $table->foreign('associated_id')->references('id')->on('associateds')->onDelete('cascade');
            $table->integer('partner_id')->unsigned();
            $table->foreign('partner_id')->references('id')->on('partners')->nullable();
            $table->integer('number')->unsigned()->nullable();
            $table->double('value', 8, 2)->default(0.00);
            $table->date('date_compensation')->nullable();
            $table->boolean('is_compensated')->default('0');
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
        Schema::dropIfExists('checkbooks');
    }
}
