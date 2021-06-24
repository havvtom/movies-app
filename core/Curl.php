<?php

class Curl
{

	public function getMovies( $url )
	{
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);

		$response = curl_exec($curl);

		if( $e = curl_error( $curl ) ){

			echo $e;
			return;

		}else {
			return json_decode($response);
		}

		curl_close($curl);
	}

	public function postFavorite( $url, $request_fields )
	{
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);

		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json'
		));


		curl_setopt($curl, CURLOPT_POSTFIELDS, $request_fields);

		// Receive server response ...
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($curl);

		if( $e = curl_error( $curl ) ){

			echo $e;
			return;

		}else {
			return json_decode($response);
		}

		curl_close($curl);
	}
}