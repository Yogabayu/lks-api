<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProvinceToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            
            $table->foreign('province_id')->references('id')->on('indonesia_provinces')->onDelete('restrict');
            $table->foreign('district_id')->references('id')->on('indonesia_cities')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lks_api', function (Blueprint $table) {
            //
        });
    }
}
