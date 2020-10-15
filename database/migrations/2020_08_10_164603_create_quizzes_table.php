<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean('publish')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->time('time')->nullable();
            $table->unsignedInteger('views_count')->default(0);
            $table->integer('votes_count')->nullable();
            $table->unsignedInteger('module_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            
            // $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('quizzes');
    }
}
