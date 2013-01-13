<?php defined('SYSPATH') OR die('No direct script access.');

class View_Admin_User_Index extends View_Admin_Base {

	public $title = 'Users';

	public function users()
	{
		$users = array();

		foreach ($this->users as $user)
		{
			$users[] = array(
				'id'         => $user->id,
				'username'   => $user->username,
				'email'      => $user->email,
				'last_login' => Date::format($user->last_login),
				'created'    => Date::format($user->created),
				'profile'    => Route::url('user.view', array('id' => $user->id)),
			);
		}

		return $users;
	}

}