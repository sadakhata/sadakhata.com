<?php

class FixHashTableSeeder extends Seeder {

	public function run()
	{
		$query = DB::table('hashTable')->whereRaw('bangla like ?', array('%অা%'));

		$affectedRows = $query->delete();

		$this->command->info('Removed ' . $affectedRows . ' rows.');
	}
}
