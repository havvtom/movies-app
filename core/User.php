<?php

class User
{
	public $username;

	public $email;

	public $id;

	public function checkLogin( $email, $password )
	{
		if( !$result = App::get('database')->whereEmail($email) ){
			return false;
		};

		if(!password_verify($password, $result[0]->password)){
			return false;
		};


		$_SESSION['username'] = $result[0]->username;

		return true;
	}
}