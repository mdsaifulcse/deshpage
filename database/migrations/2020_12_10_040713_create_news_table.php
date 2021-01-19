<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('feature_photo');
            $table->string('feature_medium')->nullable();
            $table->string('feature_small')->nullable();
            $table->string('photo_caption')->nullable();
            $table->longText('meta_description');
            $table->longText('description');
            $table->string('topic')->nullable();
            $table->string('video_url')->nullable();
            $table->string('published_status')->default(\App\Models\News::UNPUBLISHED);
            $table->dateTime('published_date')->nullable();

            $table->string('is_cover_news')->default(\App\Models\News::NO);
            $table->string('show_at_homepage')->default(\App\Models\News::NO);

            $table->tinyInteger('serial_num',false,4)->default(1);

            $table->unsignedBigInteger('category_id',false,20);
            $table->unsignedBigInteger('sub_cat_id',false,20)->nullable();

            $table->unsignedBigInteger('division_id',false,20)->nullable();
            $table->unsignedBigInteger('district_id',false,20)->nullable();

            $table->unsignedBigInteger('news_author_id',false,20)->nullable();

            $table->author();
            $table->softDeletes();

            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('sub_cat_id')->references('id')->on('sub_categories');
            $table->foreign('news_author_id')->references('id')->on('users');
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
        Schema::table('news',function (Blueprint $table){
            $table->dropForeign(['category_id']);
            $table->dropForeign(['sub_cat_id']);
            $table->dropForeign(['division_id']);
            $table->dropForeign(['district_id']);
            $table->dropForeign(['news_author_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::dropIfExists('news');
    }
}
