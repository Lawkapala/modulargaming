<?php defined('SYSPATH') OR die('No direct script access.');

class Policy_Forum_Topic_Create extends Policy {

	public function execute(Model_ACL_User $user, array $extra = NULL)
	{
		$category = $extra['category'];

		if ($category->locked == 0 OR $user->has('roles', Model_Role::ADMIN))
		{
			return TRUE;
		}

		return FALSE;
	}
}