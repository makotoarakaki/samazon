<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokuteisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokuteis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('seller');
            $table->string('administrator');
            $table->string('tel');
            $table->string('address');
            $table->string('contact');
            $table->text('delivery_time')->default(null);
            $table->text('delivery_of_goods')->default(null);
            $table->text('caution')->default(null);
            $table->text('personal_information')->default(null);
            $table->string('required_fee')->default(null);
            $table->text('payment_method')->default(null);
            $table->string('payment_time_credit')->default(null);
            $table->string('payment_time_bank_transfer')->default(null);
            $table->text('cancel')->default(null);
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
        Schema::dropIfExists('tokuteis');
    }
}
