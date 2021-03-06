<?php namespace Course\Http\Controllers;

	use Course\User;

	class UsersControllers extends Controller {

		public function getOrm()
		{
			$users = User::select('id', 'first_name')->with('profile')->where('first_name', '<>', 'Sender')->orderBy('first_name', 'ASC')->get();
			dd($users->toArray());
		}


		public function getIndex()
		{
			$result = \DB::table('users')
				->select('users.*', 'user_profiles.id as profile_id', 'user_profiles.twitter', 'user_profiles.birthdate')
				//->where('first_name', '<>', 'Sender')
				->orderby('id', 'ASC')
				->leftJoin('user_profiles', 'users.id', '=', 'user_profiles.user_id')
				->get();

			foreach ($result as $row)
			{
				$row->fullname = $row->first_name . ' ' . $row->last_name;
				$row->age = \Carbon\Carbon::parse($row->birthdate)->age;
			}

			 
			dd($result);
			return $result;
		}

	}