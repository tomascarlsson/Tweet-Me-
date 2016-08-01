<?php
/**
 * Get the id for the logged in user
 * @return string
 */
function getUserId($session_email){
	$db = new Database;
	$db->query('SELECT id FROM user WHERE email = (:session_email)');
	$db->bind(':session_email', $session_email );
	$db->execute();

	// Assign Result Set
	$results = $db->single();
	return $results->id;
}

/**
 * Get the user image
 * @return url to the picture
 */
function getUserImage($session_email){
	$db = new Database;
	$userId = getUserId($session_email);
	$db->query('SELECT picture FROM user_detail WHERE user_id = (:user_id)');
	$db->bind(':user_id', $userId);
	$db->execute();

	// Assign Result Set
	$results = $db->single();
	return $results->picture;
}

/**
 * Checks if choosen username is already taken 
 * @return boolean
 */
function checkUsernameInDatabase($username){
	$db = new Database;
	$db->query('SELECT username FROM user_detail WHERE username = (:username)');
	$db->bind(':username', $username);
	$db->execute();

	// Assign Result Set
	$rowsInDatabase = $db->rowCount();
	if($rowsInDatabase > 0) { 
		return false;
	}
	else { 
		return true;
	};
}




