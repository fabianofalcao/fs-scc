<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associateds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('marital_status_id')->unsigned();
            $table->integer('bank_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('marital_status_id')->references('id')->on('marital_statuses')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->string('bank_branch', 8)->nullable();
            $table->string('bank_account', 10)->nullable();
            $table->enum('bank_type_account', ['Conta corrente', 'Poupança'])->nullable();
            $table->string('role')->nullable();
            $table->date('admission_date')->nullable();
            $table->date('affiliation_date')->nullable();
            $table->string('automatic_debit_code', 20)->nullable();
            $table->double('credit_limit', 8, 2)->default(0.00);
            $table->enum('status', ['Ativo', 'Inativo', 'Suspenso', 'Outro']);
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
        Schema::dropIfExists('associateds');
    }
}
