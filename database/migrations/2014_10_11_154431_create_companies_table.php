<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('cnpj', 14)->unique();
            $table->string('ie', 20)->nullable();
            $table->string('im', 20)->nullable();
            $table->string('responsible_name', 100)->nullable();
            $table->string('email', 191)->unique();
            $table->string('phone', 12)->nullable();
            $table->string('cell', 12)->nullable();
            $table->string('address_zipcode', 8)->nullable();
            $table->string('address_street', 100)->nullable();
            $table->string('address_number', 30)->nullable();
            $table->string('address_complement', 60)->nullable();
            $table->string('address_neighborhood', 100)->nullable();
            $table->string('address_city', 100)->nullable();
            $table->string('address_state', 60)->nullable();
            $table->string('site', 191)->nullable();
            $table->string('path_logo', 191)->nullable();
            $table->longText('cfg_txt_sale', 191)->nullable();
            $table->longText('cfg_txt_service', 191)->nullable();
            $table->integer('cfg_records_per_page')->default(10);
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
        Schema::dropIfExists('companies');
    }
}
