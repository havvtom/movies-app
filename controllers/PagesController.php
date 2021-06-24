<?php

class PagesController
{

	public function home()
	{

		$url = "https://api.themoviedb.org/3/movie/popular?api_key={$this->getApiKey()}";

		if ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] >= 1 && $_REQUEST['page'] <= 5){
			$url = "https://api.themoviedb.org/3/movie/popular?api_key={$this->getApiKey()}&page=".$_REQUEST['page'];
		}

		$movies = (new Curl)->getMovies( $url );

		$favorites = App::get('database')->selectAll('favorites', Favorite::class);	
		$_SESSION['favorites'] = array_column($favorites, 'movie_id');

		return view('index', $data = $movies );
	}

	public function contact()
	{
		return view('contact', "");
	}

	public function favorite()
	{
		
		$postRequest = array(
				    'media_id' => $_REQUEST['movie_id'],
				    'media_type' => 'movie',
				    'favorite' => true
				);
		$postRequest = json_encode($postRequest);

		$url = "https://api.themoviedb.org/3/account/{$this->getAccountId()}/favorite?api_key={$this->getApiKey()}&session_id={$this->getSessionId()}";

		(new Curl)->postFavorite( $url, $postRequest );

		App::get('database')->create($_REQUEST, 'favorites');

	}

	public function unfavorite()
	{
		
		$postRequest = array(
				    'media_id' => $_REQUEST['movie_id'],
				    'media_type' => 'movie',
				    'favorite' => false
				);
		$postRequest = json_encode($postRequest);

		$url = "https://api.themoviedb.org/3/account/{$this->getAccountId()}/favorite?api_key={$this->getApiKey()}&session_id={$this->getSessionId()}";

		(new Curl)->postFavorite( $url, $postRequest );

		App::get('database')->delete($_REQUEST['movie_id'], 'favorites');

	}

	public function favorites()
	{
		$url = "https://api.themoviedb.org/3/account/{$this->getAccountId()}/favorite/movies?api_key={$this->getApiKey()}&language=en-US&sort_by=created_at.asc&page=1&session_id={$this->getSessionId()}";

		if ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] >= 1 && $_REQUEST['page'] <= 5){
			$url = "https://api.themoviedb.org/3/account/{$this->getAccountId()}/favorite/movies?api_key={$this->getApiKey()}&language=en-US&sort_by=created_at.asc&page={$_REQUEST['page']}&session_id={$this->getSessionId()}";
		}

		$movies = (new Curl)->getMovies( $url );

		return view('index', $data = $movies );
	}

	protected function getApiKey(){

		return App::get('config')['tmdb']['api_key'];
	}

	protected function getSessionId(){
		
		return App::get('config')['tmdb']['session_id'];
	}

	protected function getAccountId(){
		
		return App::get('config')['tmdb']['account_id'];
	}
}