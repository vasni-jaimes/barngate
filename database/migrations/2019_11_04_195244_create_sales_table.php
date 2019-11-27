<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('sale_id');
            $table->integer('user_id');
            $table->integer('animal_id');
            $table->integer('breed_id');
            $table->integer('color_id');
            $table->integer('gender_id');
            $table->integer('age_id');
            $table->integer('discipline_id');
            $table->integer('temperament');
            $table->string('price');
            $table->text('description');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('country');
            $table->string('phone_number');
            $table->integer('plan_id');
            $table->dateTime('date_init');
            $table->dateTime('date_end');
            $table->integer('homepage');
            $table->string('video')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
