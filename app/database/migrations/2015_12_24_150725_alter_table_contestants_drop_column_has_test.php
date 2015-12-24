<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableContestantsDropColumnHasTest extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contestants', function(Blueprint $table){
            $table->dropColumn('hasTest');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contestants', function(Blueprint $table){
            $table->integer('hasTest');
        });
	}

}
