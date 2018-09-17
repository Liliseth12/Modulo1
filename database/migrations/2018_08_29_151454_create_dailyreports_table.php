<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dailyreports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();   
            $table->date('date')->nullable();
            $table->time('arrival_time')->nullable();
            $table->time('departure_time')->nullable();
            $table->time('delay')->nullable();
            $table->time('early')->nullable();
            $table->time('extrahour')->nullable();
            $table->boolean('deduction')->default(0);
            $table->boolean('assignment')->default(0);
            $table->string('justification')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dailyreports');
    }
}
