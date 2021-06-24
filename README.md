The movies-app is a program made from a small php framework that I made. The framework tries to follow the laravel framework. 
For the application to run after cloning it, there are 2 steps that need to be fulfilled. First, there are keys that need to 
be configured in the config.php file. The program gets all the movies and information from the movies database api. These keys 
are api_key, account_id and session_id. For you to get these keys you need to sign up and configure your account with themoviedb.org.
More information can be found
"https://developers.themoviedb.org/3/getting-started/introduction"

. Once you get the keys you need to replace api_key, session_id, account_id values in the config.php file

```
'tmdb' => [
		
		'api_key' => 'YOUR_API_KEY',

		'session_id' => 'YOUR_SESSION_ID',

		'account_id' => 'YOUR_ACCOUNT_ID'
	]
```
The last step is to run the database dump (aglet.sql) thats found in core/database directory. Once thats done set up your local server and you are good to go.

