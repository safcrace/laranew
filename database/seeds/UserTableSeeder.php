<?php

	use Illuminate\Database\Seeder;
	use Faker\Factory as Faker;

	Class UserTableSeeder extends Seeder {

		public function run()
		{
			$faker = Faker::create();

			for($i = 0; $i < 200; $i ++)
			{
				$firstName = $faker->firstName;
				$lastName = $faker->lastName;
				$id = \DB::table('users')->insertGetId(array (
					'first_name'	=>		$firstName,
					'last_name'		=>		$lastName,
					'email'		=>			$faker->unique()->email,
					'password'	=>		\Hash::make('secret'),
					'type'		=>		$faker->randomElement(['editor', 'contributor', 'subscriber', 'user'])

				));

				\DB::table('user_profiles')->insert(array (
					'user_id'		=>		$id,
					'bio'			=>		$faker->paragraph(rand(2,5)),
					'website'		=>		'http://www.' . $faker->domainName,
					'twitter'		=>		'http://www.twitter.com/' . $faker->userName,
					'birthdate'		=>		$faker->dateTimeBetween('-45 year', '-15 year')->format('Y-m-d')
				));
			}
		}
	}