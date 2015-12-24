<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableContestantsDropColumnPassword extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contestants', function(Blueprint $blueprint){
           $blueprint->dropColumn('password');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contestants', function(Blueprint $blueprint){
           $blueprint->string('password');
        });
	}

}
