<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associate_agreements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('associated_id')->unsigned();
            $table->foreign('associated_id')->references('id')->on('associateds')->onDelete('cascade');
            $table->integer('covenant_id')->unsigned();
            $table->foreign('covenant_id')->references('id')->on('covenants')->onDelete('cascade');
            $table->integer('dependent_id')->unsigned()->nullable();
            $table->foreign('dependent_id')->references('id')->on('dependents');
            $table->enum('month', ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']);
            $table->integer('year');
            $table->double('value', 8, 2)->default(0.00);
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
        Schema::dropIfExists('associate_agreements');
    }
}
