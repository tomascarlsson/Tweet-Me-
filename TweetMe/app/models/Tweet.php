<?php 
/**
 * ==================
 * The Tweet Class
 * - handles tweets 
 * ==================
 */
class Tweet{
	// Database property
	private $db;

	// User property
	private $user;

	/**
	 * Constructor method
	 * creates a new database object
	 */
	public function __construct(){
		$this->db = new Database;
	}



	/**
	 * Add Tweet to Database
	 */
	public function addTweet(){
		$userId = getUserId( Session::get('user_email') );
		$tweetMessage = $_POST['message'];
		// Insert User
		$this->db->query('INSERT INTO tweet (message, user_id, date) VALUES (:message, :user_id, now())');
		//Bind Values
		$this->db->bind(':message', $tweetMessage);
		$this->db->bind(':user_id', $userId);
		//Execute
		$this->db->execute();

		return true;
	}


	/**
	 * Get User Tweets
	 * @return array
	 */
	public function getUserTweets(){
		$userId = getUserId( Session::get('user_email') );
		$this->db->query('
			SELECT  * FROM user_detail 
			JOIN tweet
			ON tweet.user_id = user_detail.user_id
			WHERE user_detail.user_id =  (:user_id)
			ORDER BY tweet.date	DESC		
			LIMIT 50
			');
		$this->db->bind(':user_id', $userId);
		$this->db->execute();

		$results = $this->db->resultset();
		return $results;
	}

	public function deleteTweet($tweetId)
	{
		$this->db->query('
			DELETE FROM tweet 
			WHERE id = (:tweetId)
			');
		$this->db->bind(':tweetId', $tweetId);
		$this->db->execute();
	}


	
	
}

