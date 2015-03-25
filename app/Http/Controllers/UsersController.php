<?php namespace Course\Http\Controllers;

	class UsersController extends Controller {

		public function getIndex()
		{
			$result = \DB::table('users')
				->select('users.*', 'user_profiles.id as profile_id', 'user_profiles.twitter')
				//->where('first_name', '<>', 'Sender')
				->orderby(\DB::raw('RAND()'))
				->leftJoin('user_profiles', 'users.id', '=', 'user_profiles.user_id')
				->get();
			dd($result);
			return $result;
		}

	}