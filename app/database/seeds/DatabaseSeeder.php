<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('UserTableSeeder');
        $this->call('QuestionsSeeder');
        $this->call('OptionsSeeder');
        $this->call('ChaptersSeeder');
        $this->call('ChaptersSeederAddColumnRate');
        $this->call('TestOptionsSeeder');
        $this->call('ContestantsSeeder');
        //$this->call('ContestantsPasswordSeeder');
    }

}
