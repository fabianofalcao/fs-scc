<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 100);
        });
        
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('person_type_id')->unsigned();
            $table->foreign('person_type_id')->references('id')->on('person_types')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('email', 191)->unique();
            $table->string('password', 191);
            $table->string('image', 191)->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('cell', 12)->nullable();
            $table->string('address_zipcode', 8)->nullable();
            $table->string('address_street', 100)->nullable();
            $table->string('address_number', 30)->nullable();
            $table->string('address_complement', 60)->nullable();
            $table->string('address_neighborhood', 100)->nullable();
            $table->string('address_city', 100)->nullable();
            $table->string('address_state', 60)->nullable();
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('person_types');
    }
}
