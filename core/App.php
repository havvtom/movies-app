<?php

class App 
{
	protected static $registry = [];

	public static function bind( $key, $value )
	{
		static::$registry[$key] = $value;

	}

	public static function get( $key )
	{
		if(! array_key_exists($key, static::$registry)) {

			throw new Exception("No key is bound to that");
			
		}
		return static::$registry[$key];
	}

	public static function resolve( $key )
	{
		return static::$registry[$key];
	}
}