<?php defined('SYSPATH') or die('No direct access allowed.');

class Controller_User extends Controller_Frontend {

	public function action_index()
	{

	}

	public function action_login()
	{

		if ($_POST)
		{
			$auth = Auth::instance();

			$post = $this->request->post();

			$remember = isset($post['remember']) ? (bool) $post['remember'] : FALSE;

			if ($auth->login($post['username'],$post['password'], $remember))
			{
				die('logged in');
				//$this->request->redirect('');
			}
			else
			{
				die('error');
			}
		}

		$this->view = new View_User_Login;
	}

	public function action_register()
	{
                if ($_POST)
                {

                        $post = $this->request->post();

		}

		$this->view = new View_User_Register;


	}



} // End User
