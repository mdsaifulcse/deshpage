<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_tracks', function (Blueprint $table) {
            $table->id();
            $table->string('visit_url')->nullable();
            $table->string('ip_address')->nullable();
            $table->tinyInteger('total_visit',false,4)->default(1);
            $table->date('visit_date');

            $table->unsignedBigInteger('user_id',false,20)->nullable();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::table('visitor_tracks',function (Blueprint $table){
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('visitor_tracks');
    }
}
