<?php

	use Illuminate\Database\Seeder;

	Class AdminTableSeeder extends Seeder {

		public function run()
		{
			\DB::table('users')->insert(array (
				'first_name'		=>		'Sender',
				'last_name'		=>		'Flores',
				'email'		=>		'safcrace@gmail.com',
				'password'	=>		\Hash::make('safcrace'),
				'type'		=>		'admin'
			));

			\DB::table('user_profiles')->insert(array (
				'user_id' => 1,
				'birthdate' => '1973/11/13'
			));
		}
	}