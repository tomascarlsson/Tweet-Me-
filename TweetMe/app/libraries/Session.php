<?php 

/**
 * ===================================
 * Session Class
 * Useful methods for the session
 * ===================================
 */
class Session {
	
	// Flag that checks if sessions is started or not
	private static $sessionStarted = false;

	/**
	 * Starts a session
	 */
	public static function start(){
		if(self::$sessionStarted == false)
			session_start();
			self::$sessionStarted = true;
	}	
	
	/**
	 * SET Session info
	 */
	public static function set($key, $value){
		$_SESSION[$key] = $value;
	} 
	
	/**
	 * GET Session info
	 */
	public static function get($key){
		if(isset($_SESSION[$key])) 
			return $_SESSION[$key];
		else
			return false;
	}

	/**
	 * Display the Session content
	 */
	public static function display(){
		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";
	}

	/**
	 * Destroys a Session
	 */
	public static function destroy(){
		if(self::$sessionStarted == true){
			session_unset();
			session_destroy();
		}
	}

	
}