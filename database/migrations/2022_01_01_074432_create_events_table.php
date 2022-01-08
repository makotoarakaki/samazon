<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('comment');
            $table->string('image')->default('');
            $table->integer('category_id')->unsigned();
            $table->integer('tax');
            $table->integer('price'); // 税抜き税込み設定
            $table->integer('pay_m'); // 販売回数
            $table->dateTime('event_date')->nullable(); // 開催日
            $table->dateTime('period_from');
            $table->dateTime('period_to')->nullable();
            $table->integer('number_sales')->nullable(); //販売数
            $table->string('ntc_email1');
            $table->string('ntc_email2')->nullable();
            $table->string('ntc_email3')->nullable();
            $table->integer('after_mail_flg'); // 後からメール送信フラグ
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
        Schema::dropIfExists('events');
    }
}
