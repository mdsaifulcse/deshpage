<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMostReadNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('most_read_news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id',false,20);
            $table->unsignedBigInteger('category_id',false,20);
            $table->integer('read_number',false,10);
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
        Schema::table('most_read_news',function (Blueprint $table){
            $table->dropForeign(['news_id']);
        });

        Schema::dropIfExists('most_read_news');
    }
}
