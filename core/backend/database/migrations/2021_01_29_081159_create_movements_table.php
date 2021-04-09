<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 20);
            $table->unsignedBigInteger('concept_id');
            $table->unsignedBigInteger('liquidation_id');
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('payment_id');
            $table->timestamps();

            $table->foreign('year_id')->references('id')->on('years')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liquidation_id')->references('id')->on('liquidations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('concept_id')->references('id')->on('concepts')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
    }
}
