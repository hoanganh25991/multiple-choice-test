<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableContestantsRenameKeyStone extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contestants', function(Blueprint $table){
            $table->renameColumn('key_stone', 'keystone');
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
            $table->renameColumn('keystone', 'key_stone');
        });
	}
}
