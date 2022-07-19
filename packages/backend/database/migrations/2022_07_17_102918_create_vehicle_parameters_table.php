<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('years')->nullable();
            $table->boolean('weight')->nullable();
            $table->boolean('capacity')->nullable();
            $table->boolean('stalls')->nullable();
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
        Schema::dropIfExists('vehicle_parameters');
    }
}
