<?php

class UserController
{
	public function store()
	{
		$data = $_REQUEST;
		$errors = [];

		if (!empty($data['username']) ||
		    !empty($data['password']) ||
		    !empty($data['email']) ||
		    !empty($data['password_confirm'])) {


		    // Check if email is valid
		    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				    // invalid email address
		    	
	    			$errors['email'] = 'Your email is invalid'; 
	    			
				}

			//Check if email is unique
			if ( App::get('database')->whereEmail($data['email']) ){

				$errors['email'] = 'The email address is taken';
			}

			//Check if password has more than 4 characters

			if ( strlen($data['password']) < 4 ){
				$errors['password'] = 'Password should have at least 4 characters';
			}
				//Check if passwords match
			if ( $data['password'] !== $data['password_confirmation'] ){
				$errors['password_confirmation'] = 'Passwords do not match';
			}

			//Register user if validation passes

			if( !count($errors)  ){

				//Remove the password_confirmation from array so that we can insert into the database
				unset($data['password_confirmation']);
  
				//Hash the password
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

				//Insert into database
				App::get('database')->create($data, 'users');

				$user = new User;

				$user->username = $data['username'];
				$user->email = $data['email'];
				$user->password = $data['password'];

				$_SESSION['username'] = $user->username; 
				
			}
				header('Content-Type: application/json');
	    		echo json_encode($errors);

	    		return; 

		}

		$errors['message'] = 'Please fill in all fields';

		header('Content-Type: application/json');
	    		echo json_encode($errors);

		return App::get('database')->create($data, 'users');
	}

	public function login()
	{
		$data = $_REQUEST;
		$errors = [];

		$user = new User;

		if( empty($data['email']) || empty($data['password']) ){
			$errors['empty_fields'] = 'You need to fill in all the fields.';
		}

		if( !$user->checkLogin( $data['email'], $data['password'] ) ){
			$errors['login_error'] = 'We could not sign you in with those details';
		}

		header('Content-Type: application/json');
	    		echo json_encode($errors);

	}

	public function logout()
	{
		session_destroy();
	}
}