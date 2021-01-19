<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsDetailPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_detail_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id',false,20);
            $table->string('photo');
            $table->string('caption')->nullable();
            $table->text('description');
            $table->string('status')->default(\App\Models\NewsDetailPhoto::ACTIVE);

            $table->foreign('news_id')->references('id')->on('news');

            $table->softDeletes();
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

        Schema::dropIfExists('news_detail_photos');
    }
}
