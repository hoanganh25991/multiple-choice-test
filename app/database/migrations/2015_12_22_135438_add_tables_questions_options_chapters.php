<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddTablesQuestionsOptionsChapters extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table){
            $table->increments('id');
            $table->string('text');
            $table->integer('chapter_id');
        });

        Schema::create('options', function(Blueprint $table){
            $table->increments('id');
            $table->string('text');
            $table->integer('is_right');
            $table->integer('question_id');
        });

        Schema::create('chapters', function(Blueprint $table){
            $table->increments('id');
            $table->string('text');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('chapters');
		Schema::dropIfExists('options');
		Schema::dropIfExists('questions');
	}

}
